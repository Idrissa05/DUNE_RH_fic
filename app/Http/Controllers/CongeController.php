<?php

namespace App\Http\Controllers;

use App\Forms\CongeForm;
use App\Models\Agent;
use App\Models\Conge;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class CongeController extends Controller {
    use FormBuilderTrait;

  public function __construct()
  {
        $this->middleware('permission:CONSULTER_CONGE');
        $this->middleware('permission:EDITER_CONGE')->only('store', 'update');
        $this->middleware('permission:SUPPRIMER_CONGE')->only('destroy');
  }

  public function index(Request $request)
  {
      if($request->ajax()) {
          return $this->getData();
      }
      $form = $this->form(CongeForm::class, [
          'method' => 'POST',
          'url' => route('conge.store')
      ]);

      $conges = Conge::with('agent')->get();

      return view('pages.agents.conges.index', [
          'form' => $form,
          'conges' => $conges
      ]);
  }

  public function store()
  {
      $form = $this->form(CongeForm::class);

      $agent = Agent::findOrFail($form->getRequest()->only('agent_id')['agent_id']);

      $form->validate(['date_debut' => 'required|date|before:date_fin|after:'.$agent->date_naiss, 'date_fin' => 'required|date|after:date_debut|after:'.$agent->date_naiss]);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      Conge::create($form->getRequest()->all());
      return redirect()->route('conge.index')->with('success', 'Opération effectuée !');

  }


  public function update(Conge $conge)
  {
      $form = $this->form(CongeForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      $conge->update($form->getRequest()->all());
      return redirect()->route('conge.index')->with('success', 'Opération effectuée !');

  }


  public function destroy(Conge $conge)
  {
      try {
          $conge->delete();
      }catch (\Exception $exception) {
          return redirect()->route('conge.index')->with('danger', "Une erreur est survenue !\n".$exception->getMessage());
      }

  }

    private function getData() {
        return DataTables::of(Conge::with('agent')
            ->orderBy('created_at', 'desc'))

            ->addColumn('id', function ($conge){
                return $conge->id;
            })
            ->addColumn('ref_decision', function ($conge){
                return $conge->ref_decision;
            })
            ->addColumn('agent', function ($conge){
                return $conge->agent->matricule;
            })
            ->addColumn('date_debut', function ($conge){
                return formaterDate($conge->date_debut);
            })
            ->addColumn('date_fin', function ($conge){
                return formaterDate($conge->date_fin);
            })
            ->addColumn('observation', function ($conge){
                return $conge->observation;
            })
            ->addColumn('actions', function ($conge){
                $html = '';
                $user = Auth::user();
                if($user->hasPermissionTo('EDITER_CONGE')) {
                    $html .= '<button id="conge'.$conge->id.'"
                                        data-debut="'.$conge->date_debut.'"
                                        data-fin="'.$conge->date_fin.'"
                                        data-ref="'.$conge->ref_decision.'"
                                        data-observation="'.$conge->observation.'"
                                        data-agent="'.$conge->agent_id.'"
                                        data-route="'.route("conge.update", $conge).'"
                                        onclick="updateConge('. $conge->id .')" class="btn btn-sm btn-outline-warning">
                                    <i class="mdi mdi-18px mdi-pencil"></i>
                                </button>';
                }

            if ($user->hasPermissionTo('SUPPRIMER_CONGE')) {

                    $html .= '<form action="'.route("conge.destroy", $conge).'" id="del'.$conge->id.'}" style="display: inline-block;" method="post">
                        '.method_field('DELETE').'
                        '.csrf_field().'
                        <button class="btn btn-outline-danger btn-sm" type="button"
                        onclick="myHelpers.deleteConfirmation(\'del'.$conge->id.'\')">
                            <i class="mdi mdi-18px mdi-trash-can-outline"></i>
                        </button>
                    </form>';
            }
            return $html;
            })
            ->escapeColumns([])
            ->make(true);
    }

}
