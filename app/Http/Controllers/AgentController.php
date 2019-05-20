<?php

namespace App\Http\Controllers;

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
          $agents = Agent::latest()->get();
          return Datatables::of($agents)
              ->addIndexColumn()
              ->addColumn('action', function($agents){
                  return '<a onclick="editData('. $agents->id .')" class="btn btn-sm btn-outline-warning" title="Modifier"><i class="mdi mdi-18px mdi-pencil"></i></a>'.' '.
                      '<a onclick="deleteData('. $agents->id .')" class="btn btn-outline-danger btn-sm" title="Supprimer"><i class="mdi mdi-18px mdi-trash-can"></i></a>';
              })
              ->rawColumns(['action'])->make(true);
      }

      $form = $this->form(AgentForm::class, [
          'method' => 'POST',
          'url' => route('agent.store'),
          'class' => 'tab-wizard wizard-circle'
      ]);
      return view('pages.agents.index', compact('form'));
  }


  public function create()
  {
      $form = $this->form(AgentForm::class, [
          'method' => 'POST',
          'url' => route('agent.store'),
          'class' => 'validation-wizard wizard-circle'
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
              $agent = Agent::create($form->getRequest()->all());
              $agent->matrimoniales()->attach($form->getRequest()->only('matrimoniale_id'), $form->getRequest()->only('date'));
              $agent->echelons()->attach($form->getRequest()->only('echelon_id'), $form->getRequest()->only('category_id','classe_id'));
              $formation = new Formation($form->getRequest()->all());
              $agent->formations()->save($formation);
              if($form->getRequest()->only('maladie_id')['maladie_id'] != null){
                  $agent->maladies()->attach($form->getRequest()->only('maladie_id'), $form->getRequest()->only('observation','date_observation'));
              }
          DB::commit();
      }
      catch (\Exception $e) {
          DB::rollBack();
          return 'Error';
      }

      return redirect()->route('agent.index')->with('success', 'Opération effectuée avec succès !');
  }


  public function show($id)
  {

  }


  public function edit($id)
  {

  }


  public function update($id)
  {

  }


  public function destroy($id)
  {

  }

}
