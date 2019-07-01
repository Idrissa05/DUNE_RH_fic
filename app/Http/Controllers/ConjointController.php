<?php

namespace App\Http\Controllers;

use App\Forms\ConjointForm;
use App\Models\Conjoint;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Yajra\DataTables\Facades\DataTables;

class ConjointController extends Controller {
    use FormBuilderTrait;


  public function index(Request $request)
  {
      if($request->ajax()) {
          return $this->getData();
      }
      return view('pages.agents.conjoints.index');

  }


  public function create()
  {
      $conjoint = new Conjoint();

      $form = $this->form(ConjointForm::class, [
          'method' => 'POST',
          'url' => route('conjoint.store'),
          'model' => $conjoint
      ]);

      return view('pages.agents.conjoints.edit', [
          'form' => $form,
          'conjoint' => $conjoint
      ]);
  }


  public function store()
  {
      $form = $this->form(ConjointForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput();
      }

      Conjoint::create($form->getRequest()->all());
      return redirect()->route('conjoint.index')->with('success', 'Enregistrement effectué');

  }


  public function edit(Conjoint $conjoint)
  {
      $form = $this->form(ConjointForm::class, [
          'method' => 'PUT',
          'url' => route('conjoint.update', $conjoint),
          'model' => $conjoint
      ]);

      return view('pages.agents.conjoints.edit', [
          'form' => $form,
          'conjoint' => $conjoint
      ]);
  }


  public function update(Conjoint $conjoint)
  {
      $form = $this->form(ConjointForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput();
      }

      $conjoint->update($form->getRequest()->all());
      return redirect()->route('conjoint.index')->with('success', 'Mise à jour effectuée');

  }


  public function destroy(Conjoint $conjoint)
  {
      try {
          $conjoint->delete();
      }catch (\Exception $exception) {
          return redirect()->route('conjoint.index')->with('danger', 'Impossible de supprimer');

      }
      return redirect()->route('conjoint.index')->with('success', 'Suppression effectuée');

  }


  private function getData() {
      return DataTables::of(Conjoint::with('agent')->orderBy('created_at', 'desc')->get())
          ->addColumn('id', function ($conjoint){
              return $conjoint->id;
          })
          ->addColumn('agent', function ($conjoint){
              return $conjoint->agent->fullName;
          })
          ->addColumn('actions', function ($conjoint){
              return '<div class="btn-group">
                    <a title="editer" href="'.route('conjoint.edit', $conjoint).'" class="btn btn-outline-warning btn-sm mr-2"><i class="mdi mdi-account-edit mdi-18px"></i></a>
                    <form action="'.route("conjoint.destroy", $conjoint).'" id="del'.$conjoint->id.'" style="display: inline-block;" method="post">
                                '.method_field('DELETE').'
                                '.csrf_field().'
                                <button title="supprimer" class="btn btn-outline-danger btn-sm" type="button"
                                onclick="myHelpers.deleteConfirmation(\'del'.$conjoint->id.'\')">
                                    <i class="mdi mdi-18px mdi-trash-can-outline"></i>
                                </button>
                            </form>
                    </div>';
          })
          ->escapeColumns([])
          ->make(true);
  }
}
