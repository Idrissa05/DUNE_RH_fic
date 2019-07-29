<?php

namespace App\Http\Controllers;

use App\Forms\EnfantForm;
use App\Models\Agent;
use App\Models\Enfant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Yajra\DataTables\Facades\DataTables;

class EnfantController extends Controller {
    use FormBuilderTrait;

    public function __construct()
    {
        $this->middleware('permission:CONSULTER_ENFANT');
        $this->middleware('permission:EDITER_ENFANT')->only('store', 'update');
        $this->middleware('permission:SUPPRIMER_ENFANT')->only('destroy');
    }


    public function index(Request $request)
    {
        if($request->ajax()) {
            return $this->getData();
        }
        return view('pages.agents.enfants.index');

    }


    public function create()
    {
        $enfant = new Enfant();

        $form = $this->form(EnfantForm::class, [
            'method' => 'POST',
            'url' => route('enfant.store'),
            'model' => $enfant
        ]);

        return view('pages.agents.enfants.edit', [
            'form' => $form,
            'enfant' => $enfant
        ]);
    }


    public function store()
    {
        $form = $this->form(EnfantForm::class);

        $agent = Agent::findOrFail($form->getRequest()->only('agent_id')['agent_id']);

        $form->validate(['date_naiss' => 'date|required|after:'.$agent->date_naiss],[
            'date_naiss.after' => 'Le champ Date de Niassance doit être une date supérieur à la date de naissance de l\'agent.'
        ]);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        Enfant::create($form->getRequest()->all());
        return redirect()->route('enfant.index')->with('success', 'Enregistrement effectué');

    }


    public function edit(Enfant $enfant)
    {
        $form = $this->form(EnfantForm::class, [
            'method' => 'PUT',
            'url' => route('enfant.update', $enfant),
            'model' => $enfant
        ]);

        return view('pages.agents.enfants.edit', [
            'form' => $form,
            'enfant' => $enfant
        ]);
    }


    public function update(Enfant $enfant)
    {
        $form = $this->form(EnfantForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $enfant->update($form->getRequest()->all());
        return redirect()->route('enfant.index')->with('success', 'Mise à jour effectuée');

    }


    public function destroy(Enfant $enfant)
    {
        try {
            $enfant->delete();
        }catch (\Exception $exception) {
            return redirect()->route('enfant.index')->with('danger', 'Impossible de supprimer');

        }
        return redirect()->route('enfant.index')->with('success', 'Suppression effectuée');

    }


    private function getData() {
        return DataTables::of(Enfant::with('agent')->orderBy('created_at', 'desc')->get())
            ->addColumn('id', function ($enfant){
                return $enfant->id;
            })
            ->addColumn('agent', function ($enfant){
                return $enfant->agent->fullName;
            })
            ->addColumn('actions', function ($enfant){
                $html = '<div class="btn-group">';
                $user = Auth::user();
                if($user->hasPermissionTo('EDITER_ENFANT')) {
                    $html .= ' <a title="editer" href="' . route('enfant.edit', $enfant) . '" class="btn btn-outline-warning btn-sm mr-2"><i class="mdi mdi-account-edit mdi-18px"></i></a>';
                }

                if($user->hasPermissionTo('SUPPRIMER_ENFANT')) {
                    $html .= ' <form action="' . route("enfant.destroy", $enfant) . '" id="del' . $enfant->id . '" style="display: inline-block;" method="post">
                                ' . method_field('DELETE') . '
                                ' . csrf_field() . '
                                <button title="supprimer" class="btn btn-outline-danger btn-sm" type="button"
                                onclick="myHelpers.deleteConfirmation(\'del' . $enfant->id . '\')">
                                    <i class="mdi mdi-18px mdi-trash-can-outline"></i>
                                </button>
                            </form>';
                }
                    $html .= '</div>';
                return $html;
            })
            ->escapeColumns([])
            ->make(true);
    }
}
