<?php

namespace App\Http\Controllers;

use App\Forms\EtablissementForm;
use App\Models\Etablissement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Yajra\DataTables\Facades\DataTables;

class EtablissementController extends Controller {
    use FormBuilderTrait;

  public function index(Request $request)
  {
      if($request->ajax()) {
          return $this->getData();
      }

      $form = $this->form(EtablissementForm::class, [
          'method' => 'POST',
          'url' => route('etablissement.store')
      ]);

      return view('configurations.etablissements.index', [
          'form' => $form
      ]);

  }


  public function store()
  {
      $form = $this->form(EtablissementForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      Etablissement::create($form->getRequest()->all());
      return redirect()->route('etablissement.index')->with('success', 'Opération effectuée !');

  }


  public function update(Etablissement $etablissement)
  {
      $form = $this->form(EtablissementForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      $etablissement->update($form->getRequest()->all());
      return redirect()->route('etablissement.index')->with('success', 'Opération effectuée !');
  }


  public function destroy(Etablissement $etablissement)
  {
      try {
          $etablissement->delete();
      }catch (\Exception $exception) {
          return redirect()->route('etablissement.index')->with('danger', 'Suppression impossible');
      }
      return redirect()->route('etablissement.index')->with('success', 'Opération effectuée !');

  }

    private function getData() {
        return DataTables::of($etablissement = Etablissement::with('secteurPedagogique', 'typeEtablissement')
            ->orderBy('name', 'asc'))

            ->addColumn('id', function ($etablissement){
                return $etablissement->id;
            })
            ->addColumn('name', function ($etablissement){
                return $etablissement->name;
            })
            ->addColumn('secteurPedagogique', function ($etablissement){
                return $etablissement->secteurPedagogique->name;
            })
            ->addColumn('typeEtablissement', function ($etablissement){
                return $etablissement->typeEtablissement->name;
            })
            ->addColumn('actions', function ($etablissement){
                $html = '<div class="btn-group">';
                $user = Auth::user();
                if($user->hasPermissionTo('ACTIONS_CONFIGURATION')) {
                    $html .= '<button id="etablissement'.$etablissement->id.'"
                                    data-secteur="'.$etablissement->secteur_pedagogique_id.'"
                                    data-type="'.$etablissement->type_etablissement_id.'"
                                    data-name="'.$etablissement->name.'"
                                    data-route="'.route("etablissement.update", $etablissement).'"
                                    onclick="updateEtablissement('. $etablissement->id .')" class="btn btn-sm btn-outline-warning">
                                <i class="mdi mdi-18px mdi-pencil"></i>
                            </button>';
                    $html .=  '<form action="'.route("etablissement.destroy", $etablissement).'" id="del'.$etablissement->id.'" style="display: inline-block;" method="post">
                                '.method_field('DELETE').'
                                '.csrf_field().'
                                <button class="btn btn-outline-danger btn-sm" type="button"
                                onclick="myHelpers.deleteConfirmation(\'del'.$etablissement->id.'\')">
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
