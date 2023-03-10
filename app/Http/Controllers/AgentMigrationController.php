<?php

namespace App\Http\Controllers;

use App\Forms\AgentMigrationForm;
use App\Models\Agent;
use App\Models\AgentMigration;
use App\Models\Titularisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Yajra\DataTables\DataTables;

class AgentMigrationController extends Controller {
    use FormBuilderTrait;

    public function __construct()
    {
        $this->middleware('permission:CONSULTER_MIGRATION');
        $this->middleware('permission:EFFECTUER_MIGRATION')->only('store', 'update');
        $this->middleware('permission:SUPPRIMER_MIGRATION')->only('destroy');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $migrations = AgentMigration::with('agent', 'grade')->orderBy('created_at', 'desc');
            return Datatables::of($migrations)
                ->addColumn('id', function ($migrations){
                    return $migrations->id;
                })
                ->addColumn('agent', function ($migrations){
                    return $migrations->agent->fullName;
                })
                ->addColumn('codeMat', function ($migrations){
                    return "<span class='label label-light-danger'>$migrations->matricule</span> => <span class='label label-light-primary'>{$migrations->agent->matricule}</span>";
                })
                ->addColumn('type', function ($migrations){
                    return "<span class='label label-light-danger'>$migrations->type</span> => <span class='label label-light-primary'>{$migrations->agent->type}</span>";
                })
                ->addColumn('cadre', function ($migrations){
                    return "<span class='label label-light-primary'>{$migrations->grade->cadre->name}</span>";
                })
                ->addColumn('corps', function ($migrations){
                    return "<span class='label label-light-primary'>{$migrations->grade->corp->name}</span>";
                })
                ->addColumn('fonction', function ($migrations){
                    return "<span class='label label-light-primary'>{$migrations->grade->fonction->name}</span>";
                })
                ->addColumn('category_id', function ($migrations){
                    return "<span class='label label-light-primary'>{$migrations->grade->category->name}</span>";
                })
                ->addColumn('classe_id', function ($migrations){
                    return "<span class='label label-light-primary'>{$migrations->grade->classe->name}</span>";
                })
                ->addColumn('echelon_id', function ($migrations){
                    return "<span class='label label-light-primary'>{$migrations->grade->echelon->name}</span>";
                })
                ->addColumn('action', function($migrations){
                    $html = '';
                    $user = Auth::user();
                    if($user->hasPermissionTo('SUPPRIMER_MIGRATION')) {
                        $html .= '<form action="'.route("migration.destroy", $migrations->id).'" id="del'.$migrations->id.'" style="display: inline-block;" method="post">
                            '.method_field('DELETE').'
                            '.csrf_field().'
                            <button class="btn btn-outline-danger btn-sm" type="button"
                            onclick="myHelpers.deleteConfirmation(\'del'.$migrations->id.'\')">
                                <i class="mdi mdi-18px mdi-trash-can-outline"></i>
                            </button>
                      </form>';
                    }

                    return $html;
                })
                ->rawColumns(['action'])->escapeColumns([])->make(true);
        }

        return view('pages.agents.migrations.index');
    }

    public function create()
    {
        $form = $this->form(AgentMigrationForm::class, [
            'method' => 'POST',
            'url' => route('migration.store')
        ]);
        return view('pages.agents.migrations.form', ['form' => $form]);
    }

    public function store()
    {
        $form = $this->form(AgentMigrationForm::class);

        $form->validate(['date_engagement' => 'date|required|after:dt_agent_test', 'date_titularisation' => 'date|required|after:dt_agent_test' ],[
            'date_engagement.after' => 'Le champ Date Engagement doit ??tre une date sup??rieur ?? la date de naissance de l\'agent.',
            'date_titularisation.after' => 'Le champ Date Titularisation doit ??tre une date sup??rieur ?? la date de naissance de l\'agent.'
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
                'type' => $form->getRequest()->only('last_type')['last_type']
            ]);

            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('migration.index')->with('danger', 'Op??ration non effectu??e, Erreur technique !');
        }

        return redirect()->route('migration.index')->with('success', 'Enregistrement effectu?? avec succ??s !');
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
                    'type' => $migrations->type
                ]);
                $migrations->forceDelete();
                $migrations->grade->forceDelete();
                DB::commit();
            }catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->route('migration.index')->with('danger', 'Impossible de supprimer cette Migration');
            }
            return redirect()->route('migration.index')->with('success', 'Suppression effectu??e');
        }
    }
}
