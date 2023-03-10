<?php

namespace App\Http\Controllers;

use App\Forms\RetraiteForm;
use App\Models\Agent;
use App\Models\Retraite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Yajra\DataTables\Facades\DataTables;

class RetraiteController extends Controller {
    use FormBuilderTrait;

    public function __construct()
    {
        $this->middleware('permission:CONSULTER_RETRAITE');
        $this->middleware('permission:EDITER_RETRAITE')->only('store', 'update');
        $this->middleware('permission:SUPPRIMER_RETRAITE')->only('destroy');
    }

    public function index(Request $request)
    {
        if($request->ajax()) {
            return $this->getData();
        }
        return view('pages.agents.retraites.index');

    }


    public function create()
    {
        $retraite = new Retraite();

        $form = $this->form(RetraiteForm::class, [
            'method' => 'POST',
            'url' => route('retraite.store'),
            'model' => $retraite
        ]);

        return view('pages.agents.retraites.edit', [
            'form' => $form,
            'retraite' => $retraite
        ]);
    }


    public function store()
    {
        $form = $this->form(RetraiteForm::class);

        $agent = Agent::findOrFail($form->getRequest()->only('agent_id')['agent_id']);

        $form->validate(['date' => 'date|required|after_or_equal:date_decision|after:'.$agent->date_naiss, 'date_decision' => 'date|required|after:'.$agent->date_naiss],[
            'date.after' => 'Le champ Date doit être une date supérieur à la date de naissance de l\'agent.',
            'date_decision.after' => 'Le champ Date décision doit être une date supérieur à la date de naissance de l\'agent.'
        ]);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        Retraite::create($form->getRequest()->all());
        $agent = Agent::findOrFail($form->getRequest()->agent_id);
        $agent->delete();
        return redirect()->route('retraite.index')->with('success', 'Enregistrement effectué');

    }


    public function edit(Retraite $retraite)
    {
        $form = $this->form(RetraiteForm::class, [
            'method' => 'PUT',
            'url' => route('retraite.update', $retraite),
            'model' => $retraite
        ]);

        return view('pages.agents.retraites.edit', [
            'form' => $form,
            'retraite' => $retraite
        ]);
    }


    public function update(Retraite $retraite)
    {
        $form = $this->form(RetraiteForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $retraite->update($form->getRequest()->all());
        return redirect()->route('retraite.index')->with('success', 'Mise à jour effectuée');

    }


    public function destroy(Retraite $retraite)
    {
        try {

            Agent::withTrashed()->find($retraite->agent_id)->restore();
            $retraite->forceDelete();
        }catch (\Exception $exception) {
            return redirect()->route('retraite.index')->with('danger', 'Impossible de supprimer');

        }
        return redirect()->route('retraite.index')->with('success', 'Suppression effectuée');

    }


    private function getData() {
        return DataTables::of(Retraite::with(['agent' => function($query) { return $query->withTrashed(); }])->orderBy('created_at', 'desc'))
            ->addColumn('id', function ($retraite){
                return $retraite->id;
            })

            ->addColumn('agent', function ($retraite){
                return $retraite->agent->matricule;
            })
            ->addColumn('actions', function ($retraite){
                $html = '<div class="btn-group">';
                $user = Auth::user();
                /*if($user->hasPermissionTo('EDITER_RETRAITE')) {
                    $html .= ' <a title="editer" href="' . route('retraite.edit', $retraite) . '" class="btn btn-outline-warning btn-sm mr-2"><i class="mdi mdi-account-edit mdi-18px"></i></a>';
                }*/

                if($user->hasPermissionTo('SUPPRIMER_RETRAITE')) {
                    $html .= ' <form action="' . route("retraite.destroy", $retraite) . '" id="del' . $retraite->id . '" style="display: inline-block;" method="post">
                                ' . method_field('DELETE') . '
                                ' . csrf_field() . '
                                <button title="supprimer" class="btn btn-outline-danger btn-sm" type="button"
                                onclick="myHelpers.deleteConfirmation(\'del' . $retraite->id . '\')">
                                    <i class="mdi mdi-18px mdi-trash-can-outline"></i>
                                </button>
                            </form>';
                }
                    $html .= ' </div>';
                return $html;
            })
            ->escapeColumns([])
            ->make(true);
    }
}
