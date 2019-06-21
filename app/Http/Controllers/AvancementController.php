<?php

namespace App\Http\Controllers;

use App\Forms\AvancementForm;
use App\Models\Agent;
use App\Models\Avancement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Yajra\DataTables\DataTables;

class AvancementController extends Controller
{
    use FormBuilderTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $avancement = Avancement::with('agent', 'category', 'classe', 'echelon')->orderBy('created_at', 'desc')->get();
            return Datatables::of($avancement)
                ->addColumn('id', function ($avancement){
                    return $avancement->id;
                })
                ->addColumn('agent', function ($avancement){
                    return $avancement->agent->fullName;
                })
                ->addColumn('category', function ($avancement){
                    return $avancement->category->name;
                })
                ->addColumn('classe', function ($avancement){
                    return $avancement->classe->name;
                })
                ->addColumn('echelon', function ($avancement){
                    return $avancement->echelon->name;
                })
                ->addColumn('date_decision_avancement', function ($avancement){
                    return formaterDate($avancement->date_decision_avancement);
                })
                ->addColumn('action', function($avancement){
                    return '<a href="'.route("avancement.edit", $avancement).'" class="btn btn-sm btn-outline-warning"><i class="mdi mdi-18px mdi-pencil"></i></a> '.' '.
                        '<form action="'.route("avancement.destroy", $avancement).'" id="del'.$avancement->id.'" style="display: inline-block;" method="post">
                            '.method_field('DELETE').'
                            '.csrf_field().'
                            <button class="btn btn-outline-danger btn-sm" type="button"
                            onclick="myHelpers.deleteConfirmation(\'del'.$avancement->id.'\')">
                                <i class="mdi mdi-18px mdi-trash-can-outline"></i>
                            </button>
                      </form>';
                })
                ->rawColumns(['action'])->make(true);
        }

        return view('pages.agents.avancements.index');
    }

    public function create()
    {
        $form = $this->form(AvancementForm::class, [
            'method' => 'POST',
            'url' => route('avancement.store')
        ]);
        return view('pages.agents.avancements.form', ['form' => $form, 'titre' => 'Ajout Avancement au Choix', 'cancelRoute' => route('avancement.index')]);
    }

    public function store()
    {
        $form = $this->form(AvancementForm::class);

        $agent = Agent::findOrFail($form->getRequest()->only('agent_id')['agent_id']);

        $form->validate(['date_decision_avancement' => 'date|required|after:'.$agent->date_naiss],[
            'date_decision_avancement.after' => 'Le champ Date Décision Avancement doit être une date supérieur à la date de naissance de l\'agent.'
        ]);


        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        Avancement::create($form->getRequest()->all());
        return redirect()->route('avancement.index')->with('success', 'Enregistrement effectué avec succès !');

    }

    public function edit(Avancement $avancement)
    {
        $form = $this->form(AvancementForm::class, [
            'method' => 'PUT',
            'url' => route('avancement.update', $avancement),
            'model' => $avancement
        ]);

        return view('pages.agents.avancements.form', [
            'form' => $form,
            'edit' => false,
            'affectation' => $avancement,
            'titre' => 'Modification Avancement',
            'cancelRoute' => route('avancement.index')
        ]);
    }

    public function update(Avancement $avancement)
    {
        $form = $this->form(AvancementForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $avancement->update($form->getRequest()->all());
        return redirect()->route('avancement.index')->with('success', 'Mise à jour effectuée');

    }

    public function destroy(Avancement $avancement)
    {
        if($avancement->agent->grades->last()->id != $avancement->id){
            return redirect()->route('avancement.index')->with('danger', 'Impossible de supprimer cet avancement');
        }else {
            try {
                $avancement->delete();
            } catch (\Exception $exception) {
                return redirect()->route('avancement.index')->with('danger', 'Impossible de supprimer');

            }
            return redirect()->route('avancement.index')->with('success', 'Suppression effectuée');
        }

    }

    public function autoIndex(Request $request)
    {
        if ($request->ajax()) {
            if(config('database','default')['default'] === 'sqlsrv'){
                $grade = DB::select(DB::raw(
                    "select g.agent_id, a.matricule, concat(a.nom ,' ',a.prenom) as full_name, i.category_id, g.category_id as current_category_id, ct.name as category, i.classe_id, g.classe_id as current_classe_id ,cl.name as classe, i.echelon_id, e.name as echelon, g.indice_id+1 as indice_id, g.type, g.date_decision_avancement, g.date_reclassement, g.date_titularisation 
                    from grades g, agents a, indices i, categories ct, classes cl, echelons e 
                    where g.id in (select max(id) from grades group by agent_id) 
                    and (DATEDIFF(day,g.date_decision_avancement,GETDATE())>=730 or DATEDIFF(day,g.date_reclassement,GETDATE())>=730 or DATEDIFF(day,g.date_titularisation,GETDATE())>=365) and g.deleted_at is null
                    and g.agent_id = a.id and g.indice_id+1 = i.id and i.category_id = ct.id and i.classe_id = cl.id and i.echelon_id = e.id")
                );
            }elseif(config('database','default')['default'] === 'pgsql'){
                $grade = DB::select(DB::raw(
                    "select g.agent_id, a.matricule, concat(a.nom ,' ',a.prenom) as full_name, i.category_id, g.category_id as current_category_id, ct.name as category, i.classe_id, g.classe_id as current_classe_id ,cl.name as classe, i.echelon_id, e.name as echelon, g.indice_id+1 as indice_id, g.type, g.date_decision_avancement, g.date_reclassement, g.date_titularisation 
                    from grades g, agents a, indices i, categories ct, classes cl, echelons e 
                    where g.id in (select max(id) from grades group by agent_id) 
                    and (CURRENT_DATE - g.date_decision_avancement >=730 or CURRENT_DATE - g.date_reclassement >=730 or CURRENT_DATE - g.date_titularisation >=365) and g.deleted_at is null
                    and g.agent_id = a.id and g.indice_id+1 = i.id and i.category_id = ct.id and i.classe_id = cl.id and i.echelon_id = e.id")
                );
            }else {
                $grade = DB::select(DB::raw(
                    "select g.agent_id, a.matricule, concat(a.nom ,' ',a.prenom) as full_name, i.category_id, g.category_id as current_category_id, ct.name as category, i.classe_id, g.classe_id as current_classe_id ,cl.name as classe, i.echelon_id, e.name as echelon, g.indice_id+1 as indice_id, g.type, g.date_decision_avancement, g.date_reclassement, g.date_titularisation 
                    from grades g, agents a, indices i, categories ct, classes cl, echelons e 
                    where g.id in (select max(id) from grades group by agent_id) 
                    and (DATEDIFF(CURRENT_DATE,g.date_decision_avancement)>=730 or DATEDIFF(CURRENT_DATE,g.date_reclassement)>=730 or DATEDIFF(CURRENT_DATE,g.date_titularisation)>=365) and g.deleted_at is null
                    and g.agent_id = a.id and g.indice_id+1 = i.id and i.category_id = ct.id and i.classe_id = cl.id and i.echelon_id = e.id")
                );
            }

            return Datatables::of($grade)
                ->addColumn('date', function ($grade){
                    if($grade->type == 'Avancement'){
                        return formaterDate($grade->date_decision_avancement);
                    }elseif ($grade->type == 'Reclassement'){
                        return formaterDate($grade->date_reclassement);
                    }else{ return formaterDate($grade->date_titularisation); }
                })
                ->addColumn('category', function ($grade){
                    if($grade->category_id != $grade->current_category_id) {
                        return "<span class='label label-danger'></span>";
                    }else return $grade->category;
                })
                ->addColumn('classe', function ($grade){
                    if($grade->classe_id != $grade->current_classe_id) {
                        return "<span class='label label-danger'></span>";
                    }else return $grade->classe;
                })
                ->addColumn('echelon', function ($grade){
                    if($grade->category_id != $grade->current_category_id or $grade->classe_id != $grade->current_classe_id) {
                        return "<span class='label label-danger'></span>";
                    }else return "<span class='label label-info'>$grade->echelon</span>";
                })
                ->addColumn('action', function($grade){
                    if($grade->category_id != $grade->current_category_id or $grade->classe_id != $grade->current_classe_id) {
                        return "<span class='label label-danger'>Avancement au Choix</span>";
                    }else return '<a href="'.route("avancement.auto.create",['data','ag' => $grade->agent_id, 'ca' => $grade->category_id, 'cl' => $grade->classe_id, 'ec' => $grade->echelon_id, 'in' => $grade->indice_id]).'" class="btn btn-sm btn-outline-info"><i class="mdi mdi-18px mdi-content-save"></i></a>';
                })
                ->rawColumns(['action'])->escapeColumns([])->make(true);
        }
        return view('pages.agents.avancements.auto');
    }

    public function autoCreate(Request $data)
    {
        $form = $this->form(AvancementForm::class, [
            'method' => 'POST',
            'url' => route('avancement.store')
        ]);
        return view('pages.agents.avancements.form', ['form' => $form, 'data' => $data, 'titre' => 'Validation Avancement Automatique', 'cancelRoute' => route('avancement.auto')]);
    }

}
