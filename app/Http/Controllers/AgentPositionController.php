<?php

namespace App\Http\Controllers;

use App\Forms\AgentPositionForm;
use App\Models\Agent;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Yajra\DataTables\DataTables;

class AgentPositionController extends Controller
{
    use FormBuilderTrait;


    public function index(Request $request) {

        if($request->ajax()) {
            return $this->getData();
        }

        $form = $this->form(AgentPositionForm::class, [
            'method' => 'POST',
            'url' => route('agent-position.store')
        ]);

        return view('pages.agents.positions.index', [
            'form' => $form
        ]);
    }


    public function store() {
        $form = $this->form(AgentPositionForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
        }

        $request = $form->getRequest();

        $position = Position::findOrFail($request->position_id);
        $agent = Agent::findOrFail($request->agent_id);
        $agent->positions()->attach($position, [
            'ref_decision'=> $request->ref_decision,
            'date_decision'=> $request->date_decision,
            'date_effet'=> $request->date_effet,
            'observation' => $request->observation,
        ]);
        return redirect()->route('agent-position.index')->with('success', 'Opération effectuée !');
    }


    public function destroy(Agent $agent,Position $position) {
        $agent->positions()->detach($position);
        return redirect()->route('agent-position.index')->with('success', 'Opération effectuée !');
    }


    private function getData() {
        $positions = DB::table('agents')
            ->join('agent_position', 'agents.id', '=', 'agent_position.agent_id')
            ->join('positions', 'positions.id', '=', 'agent_position.position_id')
            ->selectRaw("agents.matricule as matricule, agents.nom as nom, agents.prenom as prenom, positions.name as position,
            agent_position.ref_decision as ref_decision, agent_position.date_decision as date_decision, agent_position.date_effet as date_effet,
            agent_position.observation as observation, agent_position.id as id, agents.id as agent_id, positions.id as position_id
            ")
            ->orderByDesc('agent_position.created_at')
            ->where('agents.deleted_at', '=', null)
            ->get();
        return DataTables::of($positions)
            ->addColumn('agent', function ($agent){
                return $agent->nom.' '.$agent->prenom;
            })
            ->addColumn('position', function ($agent){
                return $agent->position;
            })
            ->addColumn('ref_decision', function ($agent){
                return $agent->ref_decision;
            })
            ->addColumn('date_decision', function ($agent){
                return $agent->date_decision;
            })
            ->addColumn('date_effet', function ($agent){
                return $agent->date_effet;
            })
            ->addColumn('observation', function ($agent){
                return $agent->observation;
            })

            ->addColumn('actions', function ($agent){
                return '<div class="btn-group">
                    <form action="'.route("agent-position.destroy", ['agent' => $agent->agent_id, 'position' => $agent->position_id]).'" id="del'.$agent->id.'" style="display: inline-block;" method="post">
                                '.method_field('DELETE').'
                                '.csrf_field().'
                                <button title="supprimer" class="btn btn-outline-danger btn-sm" type="button"
                                onclick="myHelpers.deleteConfirmation(\'del'.$agent->id.'\')">
                                    <i class="mdi mdi-18px mdi-trash-can-outline"></i>
                                </button>
                            </form>
                    </div>';
            })
            ->escapeColumns([])
            ->make(true);
    }
}
