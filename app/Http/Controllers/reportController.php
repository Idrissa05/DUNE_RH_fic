<?php

namespace App\Http\Controllers;

use App\Models\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use timgws\QueryBuilderParser;
use Yajra\DataTables\Facades\DataTables;

class reportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:GENERER_REQUETE');
    }

    public function index()
    {
        $queries = Query::orderBy('name')->get();
        return view('reports.index', compact('queries'));
    }

    public function show(){
        $rules = $_POST['rules'];
        $qbp = new QueryBuilderParser([
            'id',
            'matricule',
            'nom',
            'prenom',
            'date_naiss',
            'lieu_naiss',
            'ref_acte_naiss',
            'date_etablissement_acte_naiss',
            'lieu_etablissement_acte_naiss',
            'sexe',
            'nationnalite',
            'agents_type',
            'date_prise_service',
            'grades_type',
            'ref_avancement',
            'date_decision_avancement',
            'observation_avancement',
            'ref_reclassement',
            'date_reclassement',
            'ref_titularisation',
            'date_titularisation',
            'ref_engagement',
            'date_engagement',
            'fonction',
            'corps',
            'cadre',
            'category_auxiliaire',
            'category',
            'classe',
            'echelon',
            'indice',
            'salary',
            'maladie',
            'observation_maladie',
            'date_observation_maladie',
            'matrimoniale',
            'date_matrimoiale',
            'old_matricule',
            'old_agents_type',
            'position',
            'date_effet_position',
            'ref_decision_position',
            'date_decision_position',
            'date_fin_position',
            'observation_position',
            'ref_affectation',
            'date_affectation',
            'date_prise_effet_affectation',
            'observation_affectation',
            'etablissement',
            'type_etablissement',
            'secteur_pedagogique',
            'inpection',
            'commune',
            'departement',
            'region',
            'ministere',
            'ref_decision_conge',
            'date_debut_conge',
            'date_fin_conge',
            'observation_conge',
            'matricule_conjoint',
            'nom_conjoint',
            'prenom_conjoint',
            'date_naiss_conjoint',
            'lieu_naiss_conjoint',
            'ref_acte_naiss_conjoint',
            'sexe_conjoint',
            'nationnalite_conjoint',
            'tel_conjoint',
            'employeur_conjoint',
            'profession_conjoint',
            'ref_acte_mariage',
            'date_mariage',
            'date_deces',
            'ref_document_deces',
            'observation_deces',
            'date_debut_formation',
            'date_fin_formation',
            'ecole_formation',
            'diplome',
            'niveau_etude',
            'equivalence_diplome',
            'prenom_enfant',
            'date_naiss_enfant',
            'lieu_naiss_enfant',
            'ref_acte_naiss_enfant',
            'sexe_enfant',
            'organisation_experience',
            'date_debut_experience',
            'date_fin_experience',
            'fonction_experience',
            'tache_experience',
            'observation_experience',
            'date_debut_notation',
            'date_fin_notation',
            'note_pedagogique',
            'note_adminitratif',
            'responsable_notation',
            'observation_notation',
            'date_retraite',
            'ref_decision_retraite',
            'date_decision_retraite',
            'lieu_retraite',
            'contact_retraite',
            'observation_retraite'
        ]);
        $query = $qbp->parse($rules, DB::table('reports'));
        if(auth()->user()->role != 'Administrateur') {
            $query->whereRaw('reports.ministere_id = ? ', [auth()->user()->ministere_id]);
        }
        return DataTables::of($query)->escapeColumns([])->make(true);
    }

    public function store(Request $request)
    {
        $input = $request->only('name', 'sql', 'fields');
        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'unique:queries,name','max:100'],
            'sql' => ['required']
        ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }
        else{
            $result = Query::create([
                'name' => $input['name'],
                'sql' => $input['sql'],
                'fields' => $input['fields']
            ]);
            return response()->json(['success' => true, 'id' => $result->id, 'name' => $result->name]);
        }
    }

    public function get()
    {
        $sql = Query::findOrFail(Input::get('id'));
        return response()->json(['sql' => $sql->sql, 'fields' => explode(",", $sql->fields)]);
    }

}
