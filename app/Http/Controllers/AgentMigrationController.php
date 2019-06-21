<?php

namespace App\Http\Controllers;

use App\Forms\ContractuelAgentMigrationForm;
use App\Models\Agent;
use App\Models\AgentMigration;
use App\Models\Titularisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Yajra\DataTables\DataTables;

class AgentMigrationController extends Controller {
    use FormBuilderTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $migrations = AgentMigration::with('agent', 'cadre', 'corp', 'fonction')->orderBy('created_at', 'desc')->get();
            return Datatables::of($migrations)
                ->addColumn('id', function ($migrations){
                    return $migrations->id;
                })
                ->addColumn('agent', function ($migrations){
                    return $migrations->agent->fullName;
                })
                ->addColumn('codeMat', function ($migrations){
                    return "<span class='label label-light-info'>$migrations->matricule</span> => <span class='label label-primary'>{$migrations->agent->matricule}</span>";
                })
                ->addColumn('type', function ($migrations){
                    return "<span class='label label-light-info'>$migrations->type</span> => <span class='label label-primary'>{$migrations->agent->type}</span>";
                })
                ->addColumn('cadre', function ($migrations){
                    return $migrations->cadre->name;
                })
                ->addColumn('corps', function ($migrations){
                    return $migrations->corp->name;
                })
                ->addColumn('fonction', function ($migrations){
                    return $migrations->fonction->name;
                })
                ->addColumn('action', function($migrations){
                    return '<form action="'.route("migration.destroy", $migrations->id).'" id="del'.$migrations->id.'" style="display: inline-block;" method="post">
                            '.method_field('DELETE').'
                            '.csrf_field().'
                            <button class="btn btn-outline-danger btn-sm" type="button"
                            onclick="myHelpers.deleteConfirmation(\'del'.$migrations->id.'\')">
                                <i class="mdi mdi-18px mdi-trash-can-outline"></i>
                            </button>
                      </form>';
                })
                ->rawColumns(['action'])->escapeColumns([])->make(true);
        }

        return view('pages.agents.migrations.index');
    }

    public function create()
    {
        $form = $this->form(ContractuelAgentMigrationForm::class, [
            'method' => 'POST',
            'url' => route('migration.store')
        ]);
        return view('pages.agents.migrations.form', ['form' => $form]);
    }

    public function store()
    {
        $form = $this->form(ContractuelAgentMigrationForm::class);

        $form->validate(['date_engagement' => 'date|required|after:dt_agent_test', 'date_titularisation' => 'date|required|after:dt_agent_test' ],[
            'date_engagement.after' => 'Le champ Date Engagement doit être une date supérieur à la date de naissance de l\'agent.',
            'date_titularisation.after' => 'Le champ Date Titularisation doit être une date supérieur à la date de naissance de l\'agent.'
        ]);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $agent = Agent::findOrFail($form->getRequest()->only('agent_id')['agent_id']);

        try {
            DB::beginTransaction();

            $agent->update($form->getRequest()->all());
            $titularisation = new Titularisation($form->getRequest()->all());
            $agent->grades()->save($titularisation);
            AgentMigration::create([
                'agent_id' => $form->getRequest()->only('agent_id')['agent_id'],
                'grade_id' => $titularisation->id,
                'matricule' => $form->getRequest()->only('code')['code'],
                'type' => $form->getRequest()->only('last_type')['last_type'],
                'cadre_id' => $form->getRequest()->only('cadre')['cadre'],
                'corp_id' => $form->getRequest()->only('corps')['corps'],
                'fonction_id' => $form->getRequest()->only('fonction')['fonction'],
            ]);

            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('migration.index')->with('danger', 'Opération non effectuée, Erreur technique !');
        }

        return redirect()->route('migration.index')->with('success', 'Enregistrement effectué avec succès !');
    }

    public function destroy($id)
    {
        $migrations = AgentMigration::with('grade', 'agent')->find($id);

        if($migrations->agent->grades->last()->id != $migrations->grade->id){
            return redirect()->route('migration.index')->with('danger', 'Impossible de supprimer cette Migration');
        }else{
            try {
                DB::beginTransaction();
                $migrations->agent->update([
                    'matricule' => $migrations->matricule,
                    'type' => $migrations->type,
                    'cadre_id' => $migrations->cadre_id,
                    'corp_id' => $migrations->corp_id,
                    'fonction_id' => $migrations->fonction_id,
                ]);
                $migrations->forceDelete();
                $migrations->grade->forceDelete();
                DB::commit();
            }catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->route('migration.index')->with('danger', 'Impossible de supprimer cette Migration');
            }
            return redirect()->route('migration.index')->with('success', 'Suppression effectuée');
        }
    }

    public function show() {
        return response()->json(Agent::with(['grades' => function ($q) {
            $q->latest()->limit(1);
        }])->find(Input::get('agent_id')));
    }
}
