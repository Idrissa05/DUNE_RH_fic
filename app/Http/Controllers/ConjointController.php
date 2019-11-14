<?php

namespace App\Http\Controllers;

use App\Forms\ConjointForm;
use App\Models\Conjoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Yajra\DataTables\Facades\DataTables;

class ConjointController extends Controller {
    use FormBuilderTrait;

    public function __construct()
    {
        $this->middleware('permission:CONSULTER_CONJOINT');
        $this->middleware('permission:EDITER_CONJOINT')->only('store', 'update');
        $this->middleware('permission:SUPPRIMER_CONJOINT')->only('destroy');
    }


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
      return DataTables::of(Conjoint::with('agent')->orderBy('created_at', 'desc'))
          ->addColumn('id', function ($conjoint){
              return $conjoint->id;
          })
          ->addColumn('agent', function ($conjoint){
              return $conjoint->agent->fullName;
          })
          ->addColumn('actions', function ($conjoint){
              $html = '<div class="btn-group">';
              $user = Auth::user();
              if($user->hasPermissionTo('EDITER_CONJOINT')) {
                  $html .= ' <a title="editer" href="' . route('conjoint.edit', $conjoint) . '" class="btn btn-outline-warning btn-sm mr-2"><i class="mdi mdi-account-edit mdi-18px"></i></a>';
              }

              if($user->hasPermissionTo('SUPPRIMER_CONJOINT')) {
                  $html .= ' <form action="' . route("conjoint.destroy", $conjoint) . '" id="del' . $conjoint->id . '" style="display: inline-block;" method="post">
                                ' . method_field('DELETE') . '
                                ' . csrf_field() . '
                                <button title="supprimer" class="btn btn-outline-danger btn-sm" type="button"
                                onclick="myHelpers.deleteConfirmation(\'del' . $conjoint->id . '\')">
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
