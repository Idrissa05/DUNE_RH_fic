<?php

namespace App\Http\Controllers;

use App\Forms\RetraiteForm;
use App\Models\Retraite;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Yajra\DataTables\Facades\DataTables;

class RetraiteController extends Controller {
    use FormBuilderTrait;


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

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        Retraite::create($form->getRequest()->all());
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
            $retraite->delete();
        }catch (\Exception $exception) {
            return redirect()->route('retraite.index')->with('danger', 'Impossible de supprimer');

        }
        return redirect()->route('retraite.index')->with('success', 'Suppression effectuée');

    }


    private function getData() {
        return DataTables::of(Retraite::with('agent')->orderBy('created_at', 'desc')->get())
            ->addColumn('id', function ($retraite){
                return $retraite->id;
            })

            ->addColumn('agent', function ($retraite){
                return $retraite->agent->matricule;
            })
            ->addColumn('actions', function ($retraite){
                return '<div class="btn-group">
                    <a title="editer" href="'.route('retraite.edit', $retraite).'" class="btn btn-outline-warning btn-sm mr-2"><i class="mdi mdi-account-edit mdi-18px"></i></a>
                    <form action="'.route("retraite.destroy", $retraite).'" id="del'.$retraite->id.'" style="display: inline-block;" method="post">
                                '.method_field('DELETE').'
                                '.csrf_field().'
                                <button title="supprimer" class="btn btn-outline-danger btn-sm" type="button"
                                onclick="myHelpers.deleteConfirmation(\'del'.$retraite->id.'\')">
                                    <i class="mdi mdi-18px mdi-trash-can-outline"></i>
                                </button>
                            </form>
                    </div>';
            })
            ->escapeColumns([])
            ->make(true);
    }
}
