<?php

namespace App\Http\Controllers;

use App\Forms\AgentMatrimonialeForm;
use App\Models\Agent;
use App\Models\Matrimoniale;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Yajra\DataTables\Facades\DataTables;

class AgentMatrimonialeController extends Controller
{
    use FormBuilderTrait;

    public function __construct()
    {
        $this->middleware('permission:CONSULTER_MATRIMONIALE');
        $this->middleware('permission:EDITER_MATRIMONIALE')->only('store', 'update');
        $this->middleware('permission:SUPPRIMER_MATRIMONIALE')->only('destroy');
    }


    public function index(Request $request) {

        if($request->ajax()) {
            return $this->getData();
        }

        $form = $this->form(AgentMatrimonialeForm::class, [
            'method' => 'POST',
            'url' => route('agent-matrimoniale.store')
        ]);

        return view('pages.agents.matrimoniales.index', [
            'form' => $form
        ]);
    }


    public function store() {
        $form = $this->form(AgentMatrimonialeForm::class);

        $agent = Agent::findOrFail($form->getRequest()->only('agent_id')['agent_id']);

        $form->validate(['date' => 'date|required|after:'.$agent->date_naiss],[
            'date.after' => 'Le champ Date doit être une date supérieur à la date de naissance de l\'agent.'
        ]);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
        }

        $request = $form->getRequest();

        $matrimoniale = Matrimoniale::findOrFail($request->matrimoniale_id);
        $agent = Agent::findOrFail($request->agent_id);

        if(in_array($matrimoniale->id, $agent->matrimoniales->pluck('id')->toArray())) {
            return redirect()->route('agent-matrimoniale.index')->with('danger', "L'agent {$agent->fullName} est déja en situation");
        }
        $agent->matrimoniales()->attach($matrimoniale, [
            'date' => $request->date,
        ]);
        return redirect()->route('agent-matrimoniale.index')->with('success', 'Opération effectuée !');
    }


    private function getData() {

        return DataTables::of(Agent::has('matrimoniales'))
            ->addColumn('matrimoniales', function ($agent){
                $html = "";
                foreach ($agent->matrimoniales as $matrimoniale) {
                    $html .= "
                    <span class='label label-light-primary'>{$matrimoniale->pivot->date}</span> --->
                    <span class='label label-light-inverse'>{$matrimoniale->name}</span>
                        <br>";
                };
                return $html;
            })
            ->escapeColumns([])
            ->make(true);
    }

}
