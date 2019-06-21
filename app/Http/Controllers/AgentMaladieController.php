<?php

namespace App\Http\Controllers;

use App\Forms\AgentMaladieForm;
use App\Models\Agent;
use App\Models\Maladie;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Yajra\DataTables\Facades\DataTables;

class AgentMaladieController extends Controller
{
    use FormBuilderTrait;


    public function index(Request $request) {

        if($request->ajax()) {
            return $this->getData();
        }

        $form = $this->form(AgentMaladieForm::class, [
            'method' => 'POST',
            'url' => route('agent-maladie.store')
        ]);

        return view('pages.agents.maladies.index', [
            'form' => $form
        ]);
    }


    public function store() {
        $form = $this->form(AgentMaladieForm::class);

        $agent = Agent::findOrFail($form->getRequest()->only('agent_id')['agent_id']);

        $form->validate(['date_observation' => 'required|date|after:'.$agent->date_naiss],[
        'date_observation.after' => 'Le champ Date observation doit être une date supérieur à la date de naissance de l\'agent.'
        ]);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
        }

        $request = $form->getRequest();

        $maladie = Maladie::findOrFail($request->maladie_id);
        $agent = Agent::findOrFail($request->agent_id);

        if(in_array($maladie->id, $agent->maladies->pluck('id')->toArray())) {
            return redirect()->route('agent-maladie.index')->with('danger', "L'agent {$agent->fullName} est déja victime de cette maladie");
        }
        $agent->maladies()->attach($maladie, [
            'observation' => $request->observation,
            'date_observation'=> $request->date_observation
        ]);
        return redirect()->route('agent-maladie.index')->with('success', 'Opération effectuée !');
    }


    public function show(Agent $agent, Request $request) {

        if($request->ajax()) {
            return $this->getMaladies($agent);
        }
        $this->getMaladies($agent);

        return view('pages.agents.maladies.show', [
            'agent' => $agent
        ]);
    }


    public function destroy(Agent $agent, Maladie $maladie) {

        $agent->maladies()->detach($maladie);
        return redirect()->route('agent-maladie.index')->with('success', 'Opération effectuée !');
    }


    private function getData() {

        return DataTables::of((Agent::all())->filter(function ($agent) { return $agent->maladies->count() > 0; }))
            ->addColumn('maladies', function ($agent){
                $html = "";
                foreach ($agent->maladies as $malady) {
                    $html .= "<span class='label label-light-danger'>{$malady->name}</span><br>";
                };
                return $html;
            })
            ->addColumn('actions', function ($agent){
                return '<div class="btn-group">
                    <a title="Détails" href="'.route('agent-maladie.show', ['id' => $agent]).'" class="btn btn-outline-info btn-sm mr-2"><i class="mdi mdi-view-list mdi-24px"></i></a>
                   
                    </div>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    private function getMaladies(Agent $agent)
    {
        return DataTables::of($agent->maladies)
            ->addColumn('maladie', function ($maladie){
                return $maladie->name;
            })
            ->addColumn('observation', function ($maladie){
                return $maladie->pivot->observation;
            })
            ->addColumn('date_observation', function ($maladie){
                return $maladie->pivot->date_observation;
            })
            ->addColumn('actions', function ($maladie) use ($agent){
                return '<div class="btn-group">
                    <form action="'.route("agent-maladie.destroy", ['agent' => $agent, 'maladie' => $maladie]).'" id="del'.$maladie->id.'" style="display: inline-block;" method="post">
                                '.method_field('DELETE').'
                                '.csrf_field().'
                                <button title="supprimer" class="btn btn-outline-danger btn-sm" type="button"
                                onclick="myHelpers.deleteConfirmation(\'del'.$maladie->id.'\')">
                                    <i class="mdi mdi-18px mdi-trash-can-outline"></i>
                                </button>
                            </form>
                    </div>';
            })
            ->escapeColumns([])
            ->make(true);
    }
}
