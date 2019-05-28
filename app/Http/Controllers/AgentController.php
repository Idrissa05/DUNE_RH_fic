<?php

namespace App\Http\Controllers;

use App\Forms\AgentEditForm;
use App\Models\Affectation;
use App\Models\Conjoint;
use App\Models\Contractuel;
use App\Models\Contrat;
use App\Models\Enfant;
use App\Models\Titulaire;
use App\Models\Titularisation;
use Illuminate\Http\Request;
use App\Forms\AgentForm;
use App\Models\Agent;
use App\Models\Formation;
use Illuminate\Support\Facades\DB;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Yajra\DataTables\DataTables;

class AgentController extends Controller {

    use FormBuilderTrait;

    public function index(Request $request)
  {
      if ($request->ajax()) {
          $agent = Agent::latest()->orderBy('created_at', 'desc');
          return Datatables::of($agent)
              ->addIndexColumn()
              ->addColumn('action', function($agent){
                  return '<a onclick="editData('. $agent->id .')" id="agent'.$agent->id.'" data-route="'.route("agent.update", $agent).'" class="btn btn-sm btn-outline-warning"><i class="mdi mdi-18px mdi-pencil"></i></a> '.' '.
                      '<form action="'.route("agent.destroy", $agent).'" id="del'.$agent->id.'" style="display: inline-block;" method="post">
                            '.method_field('DELETE').'
                            '.csrf_field().'
                            <button class="btn btn-outline-danger btn-sm" type="button"
                            onclick="myHelpers.deleteConfirmation(\'del'.$agent->id.'\')">
                                <i class="mdi mdi-18px mdi-trash-can-outline"></i>
                            </button>
                      </form>';
              })
              ->rawColumns(['action'])->make(true);
      }

      $form = $this->form(AgentEditForm::class, [
          'method' => 'POST',
          'class' => 'tab-wizard wizard-circle'
      ]);

      return view('pages.agents.index', compact('form'));
  }


  public function create()
  {
      $form = $this->form(AgentForm::class, [
          'method' => 'POST',
          'url' => route('agent.store'),
          'class' => 'tab-wizard wizard-circle'
      ]);
      return view('pages.agents.create', compact('form'));
  }


  public function store()
  {
      $form = $this->form(AgentForm::class);

      if (!$form->isValid()) {
        return redirect()->back()->withErrors($form->getErrors())->withInput();
      }

      try {
          DB::beginTransaction();
              // Inserion Agents
              if($form->getRequest()->only('type')['type'] == 'Titulaire'){
                  // Inserion Agent Titulaire
                  $agent = Titulaire::create($form->getRequest()->all());
                  // Insertion Grade
                  $titularisation = new Titularisation($form->getRequest()->all());
                  $agent->grades()->save($titularisation);
              }elseif($form->getRequest()->only('type')['type'] == 'Contractuel') {
                  // Inserion Agent Contractuel
                  $agent = Contractuel::create($form->getRequest()->all());
                  // Insertion Grade
                  $contrat = new Contrat($form->getRequest()->all());
                  $agent->grades()->save($contrat);
              }else return redirect()->route('agent.create')->with('danger', 'Opération non effectuée, Erreur technique !');

              // Inserion Situation Matrimoniale
              $agent->matrimoniales()->attach($form->getRequest()->only('matrimoniale_id'), $form->getRequest()->only('date'));

              // Insertion Affectations
              $affectation = new Affectation([
                  "ref" => $form->getRequest()->only('ref')['ref'],
                  "date" => $form->getRequest()->only('date_affectation')['date_affectation'],
                  "date_prise_effet" => $form->getRequest()->only('date_prise_effet')['date_prise_effet'],
                  "observation" => $form->getRequest()->only('observation_affectation')['observation_affectation'],
                  "etablissement_id" => $form->getRequest()->only('etablissement_id')['etablissement_id']
              ]);
              $agent->affectations()->save($affectation);

              // Insertion Formation (Niveau d'Etude)
              $formation = new Formation($form->getRequest()->all());
              $agent->formations()->save($formation);

              // Insertion Maladies Connues
              if($form->getRequest()->only('maladie_id')['maladie_id'] != null){
                  $agent->maladies()->attach($form->getRequest()->only('maladie_id'), $form->getRequest()->only('observation','date_observation'));
              }

              // Insertion Enfants
              $enfants = $form->getRequest()->only('prenom_enfant');
              if(isset($enfants) && isset($enfants['prenom_enfant'])){
                  foreach($enfants['prenom_enfant'] as $key => $prenom){
                      $enfant = new Enfant([
                          'prenom' => $prenom,
                          'date_naiss' => $form->getRequest()->only('date_naiss_enfant')['date_naiss_enfant'][$key],
                          'lieu_naiss' => $form->getRequest()->only('lieu_naiss_enfant')['lieu_naiss_enfant'][$key],
                          'sexe' => $form->getRequest()->only('sexe_enfant')['sexe_enfant'][$key],
                      ]);
                      $agent->enfants()->save($enfant);
                  }
              }

              // Insertion Conjoints
              $conjoints = $form->getRequest()->only('nom_conjoint');
              if(isset($conjoints) && isset($conjoints['nom_conjoint'])){
                  foreach($conjoints['nom_conjoint'] as $key => $nom){
                      $conjoint = new Conjoint([
                          'matricule' => $form->getRequest()->only('matricule_conjoint')['matricule_conjoint'][$key],
                          'nom' => $nom,
                          'prenom' => $form->getRequest()->only('prenom_conjoint')['prenom_conjoint'][$key],
                          'date_naiss' => $form->getRequest()->only('date_naiss_conjoint')['date_naiss_conjoint'][$key],
                          'lieu_naiss' => $form->getRequest()->only('lieu_naiss_conjoint')['lieu_naiss_conjoint'][$key],
                          'sexe' => $form->getRequest()->only('sexe_conjoint')['sexe_conjoint'][$key],
                          'nationnalite' => $form->getRequest()->only('nationnalite_conjoint')['nationnalite_conjoint'][$key],
                          'tel' => $form->getRequest()->only('tel')['tel'][$key],
                          'employeur' => $form->getRequest()->only('employeur')['employeur'][$key],
                          'profession'  => $form->getRequest()->only('profession')['profession'][$key],
                          'ref_acte_mariage' => $form->getRequest()->only('ref_acte_mariage')['ref_acte_mariage'][$key],
                      ]);
                      $agent->conjoints()->save($conjoint);
                  }
              }

          DB::commit();
      }
      catch (\Exception $e) {
          DB::rollBack();
          return redirect()->route('agent.create')->with('danger', 'Opération non effectuée, Erreur technique !');
      }

      return redirect()->route('agent.index')->with('success', 'Opération effectuée avec succès !');
  }


  public function show($id)
  {

  }


  public function edit($id)
  {
      $agent = Agent::findOrFail($id);
      return response()->json([$agent, $agent->grades]);
  }


  public function update(Agent $agent)
  {
      $form = $this->form(AgentEditForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput();
      }

      try {
          DB::beginTransaction();

          $agent->update($form->getRequest()->all());

          if($form->getRequest()->only('type')['type'] == 'Titulaire'){
              DB::table('agents')->where('id', $agent->id)->update(['fonction_id' => $form->getRequest()->only('fonction_id')['fonction_id']]);
              $agent->grades()->update([
                  'category_id' => $form->getRequest()->only('category_id')['category_id'],
                  'classe_id' => $form->getRequest()->only('classe_id')['classe_id'],
                  'echelon_id' => $form->getRequest()->only('echelon_id')['echelon_id'],
                  'ref_titularisation' => $form->getRequest()->only('ref_titularisation')['ref_titularisation'],
                  'date_titularisation' => $form->getRequest()->only('date_titularisation')['date_titularisation'],
                  'ref_engagement' => $form->getRequest()->only('ref_engagement')['ref_engagement'],
                  'date_engagement' => $form->getRequest()->only('date_engagement')['date_engagement'],
                  'type' => 'Titularisation',
              ]);
          }else {
              DB::table('agents')->where('id', $agent->id)->update(['date_prise_service' => $form->getRequest()->only('date_prise_service')['date_prise_service']]);
              $agent->grades()->update([
                  'category_id' => $form->getRequest()->only('category_id')['category_id'],
                  'ref_engagement' => $form->getRequest()->only('ref_engagement')['ref_engagement'],
                  'date_engagement' => $form->getRequest()->only('date_engagement')['date_engagement'],
                  'type' => 'Contrat',
              ]);
          }
              DB::commit();
          }
      catch (\Exception $e) {
          DB::rollBack();
          return redirect()->route('agent.index')->with('danger', 'Opération non effectuée, Erreur technique !');
      }

      return redirect()->route('agent.index')->with('success', 'Opération effectuée avec succès !');
  }


  public function destroy(Agent $agent)
  {
      try {
          $agent->delete();

      }catch (\Exception $exception) {
          return redirect()->route('agent.index')->with('danger', 'Suppression Impossible !');
      }
      return redirect()->route('agent.index')->with('success', 'Opération effectuée avec succès !');
  }

}
