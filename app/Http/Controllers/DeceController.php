<?php

namespace App\Http\Controllers;

use App\Forms\DeceForm;
use App\Models\Agent;
use App\Models\Dece;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Yajra\DataTables\Facades\DataTables;

class DeceController extends Controller {
    use FormBuilderTrait;

    public function __construct()
    {
        $this->middleware('permission:CONSULTER_DECE');
        $this->middleware('permission:EDITER_DECE')->only('store', 'update');
        $this->middleware('permission:SUPPRIMER_DECE')->only('destroy');
    }


    public function index(Request $request)
    {
        if($request->ajax()) {
            return $this->getData();
        }
        return view('pages.agents.deces.index');

    }


    public function create()
    {
        $dece = new Dece();

        $form = $this->form(DeceForm::class, [
            'method' => 'POST',
            'url' => route('deces.store'),
            'model' => $dece
        ]);

        return view('pages.agents.deces.edit', [
            'form' => $form,
            'dece' => $dece
        ]);
    }


    public function store()
    {
        $form = $this->form(DeceForm::class);

        $agent = Agent::findOrFail($form->getRequest()->only('agent_id')['agent_id']);

        $form->validate(['date' => 'date|required|after:'.$agent->date_naiss],[
            'date.after' => 'Le champ Date doit être une date supérieur à la date de naissance de l\'agent.'
        ]);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        Dece::create($form->getRequest()->all());
        $agent = Agent::findOrFail($form->getRequest()->agent_id);
        $agent->delete();
        return redirect()->route('deces.index')->with('success', 'Enregistrement effectué');

    }


    public function edit(Dece $dece)
    {
        $form = $this->form(DeceForm::class, [
            'method' => 'PUT',
            'url' => route('deces.update', $dece),
            'model' => $dece
        ]);

        return view('pages.agents.deces.edit', [
            'form' => $form,
            'dece' => $dece
        ]);
    }


    public function update(Dece $dece)
    {
        $form = $this->form(DeceForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $dece->update($form->getRequest()->all());
        return redirect()->route('deces.index')->with('success', 'Mise à jour effectuée');

    }


    public function destroy(Dece $dece)
    {
        try {
           Agent::withTrashed()->find($dece->agent_id)->restore();
            $dece->forceDelete();
        }catch (\Exception $exception) {
            return redirect()->route('deces.index')->with('danger', 'Impossible de supprimer');

        }
        return redirect()->route('deces.index')->with('success', 'Suppression effectuée');

    }


    private function getData() {
        return DataTables::of(Dece::with(['agent' => function($query) { return $query->withTrashed(); }])->orderBy('created_at', 'desc'))
            ->addColumn('id', function ($dece){
                return $dece->id;
            })

            ->addColumn('agent', function ($dece){
                return $dece->agent->matricule;
            })
            ->addColumn('actions', function ($dece){
                $html = '<div class="btn-group">';
                $user = Auth::user();
                /*if($user->hasPermissionTo('EDITER_DECE')) {
                    $html .= ' <a title="editer" href="' . route('deces.edit', $dece) . '" class="btn btn-outline-warning btn-sm mr-2"><i class="mdi mdi-account-edit mdi-18px"></i></a>';
                }*/

                if($user->hasPermissionTo('SUPPRIMER_DECE')) {
                    $html .= ' <form action="' . route("deces.destroy", $dece) . '" id="del' . $dece->id . '" style="display: inline-block;" method="post">
                                ' . method_field('DELETE') . '
                                ' . csrf_field() . '
                                <button title="supprimer" class="btn btn-outline-danger btn-sm" type="button"
                                onclick="myHelpers.deleteConfirmation(\'del' . $dece->id . '\')">
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
