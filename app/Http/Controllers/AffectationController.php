<?php

namespace App\Http\Controllers;

use App\Forms\AffectationForm;
use App\Models\Affectation;
use App\Models\Agent;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Yajra\DataTables\Facades\DataTables;

class AffectationController extends Controller {
    use FormBuilderTrait;


    public function index(Request $request)
    {
        if($request->ajax()) {
            return $this->getData();
        }
        return view('pages.agents.affectations.index');

    }


    public function create()
    {
        $affectation = new Affectation();

        $form = $this->form(AffectationForm::class, [
            'method' => 'POST',
            'url' => route('affectation.store'),
            'model' => $affectation
        ]);

        return view('pages.agents.affectations.edit', [
            'form' => $form,
            'affectation' => $affectation
        ]);
    }


    public function store()
    {
        $form = $this->form(AffectationForm::class);

        $agent = Agent::findOrFail($form->getRequest()->only('agent_id')['agent_id']);

        $form->validate(['date' => 'date|required|before:date_prise_effet|after:'.$agent->date_naiss, 'date_prise_effet' => 'date|required|after_or_equal:date|after:'.$agent->date_naiss ],[
            'date.after' => 'Le champ Date Affectation doit être une date supérieur à la date de naissance de l\'agent.',
            'date_prise_effet.after' => 'Le champ Date Affectation doit être une date supérieur à la date de naissance de l\'agent.',
        ]);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        Affectation::create($form->getRequest()->all());
        return redirect()->route('affectation.index')->with('success', 'Enregistrement effectué');

    }


    public function edit(Affectation $affectation)
    {
        $form = $this->form(AffectationForm::class, [
            'method' => 'PUT',
            'url' => route('affectation.update', $affectation),
            'model' => $affectation
        ]);

        return view('pages.agents.affectations.edit', [
            'form' => $form,
            'affectation' => $affectation
        ]);
    }


    public function update(Affectation $affectation)
    {
        $form = $this->form(AffectationForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $affectation->update($form->getRequest()->all());
        return redirect()->route('affectation.index')->with('success', 'Mise à jour effectuée');

    }


    public function destroy(Affectation $affectation)
    {
        try {
            $affectation->delete();
        }catch (\Exception $exception) {
            return redirect()->route('affectation.index')->with('danger', 'Impossible de supprimer');

        }
        return redirect()->route('affectation.index')->with('success', 'Suppression effectuée');

    }


    private function getData() {
        return DataTables::of(Affectation::with('agent', 'etablissement')->orderBy('created_at', 'desc')->get())
            ->addColumn('id', function ($affectation){
                return $affectation->id;
            })

            ->addColumn('agent', function ($affectation){
                return $affectation->agent->fullName;
            })
            ->addColumn('etablissement', function ($affectation){
                return $affectation->etablissement->name;
            })
            ->addColumn('actions', function ($affectation){
                return '<div class="btn-group">
                    <a title="editer" href="'.route('affectation.edit', $affectation).'" class="btn btn-outline-warning btn-sm mr-2"><i class="mdi mdi-account-edit mdi-18px"></i></a>
                    <form action="'.route("affectation.destroy", $affectation).'" id="del'.$affectation->id.'" style="display: inline-block;" method="post">
                                '.method_field('DELETE').'
                                '.csrf_field().'
                                <button title="supprimer" class="btn btn-outline-danger btn-sm" type="button"
                                onclick="myHelpers.deleteConfirmation(\'del'.$affectation->id.'\')">
                                    <i class="mdi mdi-18px mdi-trash-can-outline"></i>
                                </button>
                            </form>
                    </div>';
            })
            ->escapeColumns([])
            ->make(true);
    }
}
