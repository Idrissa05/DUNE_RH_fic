<?php

namespace App\Http\Controllers;

use App\Forms\NotationForm;
use App\Models\Agent;
use App\Models\Notation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Yajra\DataTables\Facades\DataTables;

class NotationController extends Controller {
    use FormBuilderTrait;

    public function __construct()
    {
        $this->middleware('permission:CONSULTER_NOTATION');
        $this->middleware('permission:EDITER_NOTATION')->only('store', 'update');
        $this->middleware('permission:SUPPRIMER_NOTATION')->only('destroy');
    }

    public function index(Request $request)
    {
        if($request->ajax()) {
            return $this->getData();
        }
        return view('pages.agents.notations.index');

    }


    public function create()
    {
        $notation = new Notation();

        $form = $this->form(NotationForm::class, [
            'method' => 'POST',
            'url' => route('notation.store'),
            'model' => $notation
        ]);

        return view('pages.agents.notations.edit', [
            'form' => $form,
            'notation' => $notation
        ]);
    }


    public function store()
    {
        $form = $this->form(NotationForm::class);

        $agent = Agent::findOrFail($form->getRequest()->only('agent_id')['agent_id']);

        $form->validate(['date_debut' => 'required|date|after:'.$agent->date_naiss, 'date_fin' => 'required|date|after:date_debut|after:'.$agent->date_naiss]);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        Notation::create($form->getRequest()->all());
        return redirect()->route('notation.index')->with('success', 'Enregistrement effectué');

    }


    public function edit(Notation $notation)
    {
        $form = $this->form(NotationForm::class, [
            'method' => 'PUT',
            'url' => route('notation.update', $notation),
            'model' => $notation
        ]);

        return view('pages.agents.notations.edit', [
            'form' => $form,
            'notation' => $notation
        ]);
    }


    public function update(Notation $notation)
    {
        $form = $this->form(NotationForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $notation->update($form->getRequest()->all());
        return redirect()->route('notation.index')->with('success', 'Mise à jour effectuée');

    }


    public function destroy(Notation $notation)
    {
        try {
            $notation->delete();
        }catch (\Exception $exception) {
            return redirect()->route('notation.index')->with('danger', 'Impossible de supprimer');

        }
        return redirect()->route('notation.index')->with('success', 'Suppression effectuée');

    }


    private function getData() {
        return DataTables::of(Notation::with('agent')->orderBy('created_at', 'desc'))
            ->addColumn('id', function ($notation){
                return $notation->id;
            })

            ->addColumn('agent', function ($notation){
                return $notation->agent->fullName;
            })
            ->addColumn('actions', function ($notation){
                $html = '<div class="btn-group">';
                $user = Auth::user();
                if($user->hasPermissionTo('EDITER_NOTATION')) {
                    $html .= ' <a title="editer" href="' . route('notation.edit', $notation) . '" class="btn btn-outline-warning btn-sm mr-2"><i class="mdi mdi-account-edit mdi-18px"></i></a>';
                }

                if($user->hasPermissionTo('SUPPRIMER_NOTATION')) {
                    $html .= ' <form action="' . route("notation.destroy", $notation) . '" id="del' . $notation->id . '" style="display: inline-block;" method="post">
                                ' . method_field('DELETE') . '
                                ' . csrf_field() . '
                                <button title="supprimer" class="btn btn-outline-danger btn-sm" type="button"
                                onclick="myHelpers.deleteConfirmation(\'del' . $notation->id . '\')">
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
