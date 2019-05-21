<?php

namespace App\Http\Controllers;

use App\Forms\FormationForm;
use App\Models\Formation;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Yajra\DataTables\Facades\DataTables;

class FormationController extends Controller {
    use FormBuilderTrait;

  public function index(Request $request)
  {
      if($request->ajax()) {
          return $this->getData();
      }
      $form = $this->form(FormationForm::class, [
          'method' => 'POST',
          'url' => route('formation.store')
      ]);

      $formations = Formation::all();
      return view('pages.agents.formations.index', [
          'form' => $form,
          'formations' => $formations
      ]);

  }


  public function store()
  {
      $form = $this->form(FormationForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput();
      }

      Formation::create($form->getRequest()->all());
      return redirect()->route('formation.index');

  }


  public function update(Formation $formation)
  {
      $form = $this->form(FormationForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput();
      }

      $formation->update($form->getRequest()->all());
      return redirect()->route('formation.index');

  }


  public function destroy(Formation $formation)
  {
      try {
          $formation->delete();

      }catch (\Exception $exception) {
          return redirect()->route('formation.index')->with('danger', 'Suppression Impossible !');
      }
      return redirect()->route('formation.index')->with('success', 'Opération effectuée !');

  }

  private function getData() {
      return DataTables::of(Formation::with('agent', 'diplome', 'niveauEtude', 'equivalenceDiplome')
          ->orderBy('created_at', 'desc')->get())

          ->addColumn('id', function ($formation){
              return $formation->id;
          })
          ->addColumn('agent', function ($formation){
              return $formation->agent->fullName;
          })
          ->addColumn('date_debut', function ($formation){
              return $formation->date_debut->format('d/m/Y');
          })
          ->addColumn('date_fin', function ($formation){
              return $formation->date_debut->format('d/m/Y');
          })
          ->addColumn('ecoleFormation', function ($formation){
              return $formation->ecoleFormation->name;
          })
          ->addColumn('diplome', function ($formation){
              return $formation->diplome->name;
          })
          ->addColumn('niveauEtude', function ($formation){
              return $formation->niveauEtude->name;
          })
          ->addColumn('equivalenceDiplome', function ($formation){
              return $formation->equivalenceDiplome->name;
          })
          ->addColumn('actions', function ($formation){
              return '<button id="formation'.$formation->id.'"
                                    data-debut="'.$formation->date_debut->format('Y-m-d').'"
                                    data-fin="'.$formation->date_fin->format('Y-m-d').'"
                                    data-ecole="'.$formation->ecole_formation_id.'"
                                    data-diplome="'.$formation->diplome_id.'"
                                    data-niveau="'.$formation->niveau_etude_id.'"
                                    data-equivalence="'.$formation->equivalence_diplome_id.'"
                                    data-route="'.route("formation.update", $formation).'"
                                    onclick="updateFormation('. $formation->id .')" class="btn btn-sm btn-outline-warning">
                                <i class="mdi mdi-18px mdi-pencil"></i>
                            </button>


                            <form action="'.route("formation.destroy", $formation).'" id="del'.$formation->id.'" style="display: inline-block;" method="post">
                                '.method_field('DELETE').'
                                '.csrf_field().'
                                <button class="btn btn-outline-danger btn-sm" type="button"
                                onclick="myHelpers.deleteConfirmation("del'.$formation->id.'")">
                                    <i class="mdi mdi-18px mdi-trash-can-outline"></i>
                                </button>
                            </form>';
          })
          ->escapeColumns([])
          ->make(true);
  }

}
