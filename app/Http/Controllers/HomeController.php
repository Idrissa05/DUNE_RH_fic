<?php

namespace App\Http\Controllers;
use App\Models\Agent;
use App\Models\Category;
use App\Models\CategoryAuxiliaire;
use App\Models\Corp;
use App\Models\Diplome;
use App\Models\Echelon;
use App\Models\Etablissement;
use App\Models\Fonction;
use App\Models\Indice;
use App\Models\Matrimoniale;
use App\Models\Position;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Builder;
use App\Config;
use Carbon\Carbon; 

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $query = Agent::all();
        $categories = Category::orderBy('name')->get()->toArray();
        $categories = array_merge($categories, CategoryAuxiliaire::orderBy('name')->get()->toArray());
        $corps = Corp::orderBy('name')->get();
        $positions = Position::orderBy('name')->get();
        $matrimoniales = Matrimoniale::orderBy('name')->get();
        $fonctions = Fonction::orderBy('name')->get();
        $regions = Region::orderBy('name')->get();
        $regionsL = Region::all();
        $agents = DB::select("SELECT a.type FROM agents a, grades g where a.id = g.agent_id GROUP by a.type");
        $nombreAgentRetraitable = Agent::nombreRetraitable();
        $nombres_par_sexe = DB::select("SELECT count(id) as nombre_agent FROM agents group by sexe");
        $nombres_par_regions = DB::select("SELECT count(id) as nombre_agent FROM agents group by created_by_region_id");
        $nombre_par_types = DB::select("SELECT count(a.id) as nombre_agent FROM agents a, grades g where a.id = g.agent_id group by a.type");
        // $s1 = DB::select("SELECT count(id) as nombre_agent, created_by_region_id, sexe FROM agents where created_by_region_id = 1 group by created_by_region_id, sexe");
        // $s2 = DB::select("SELECT count(id) as nombre_agent, created_by_region_id, sexe FROM agents where created_by_region_id = 2 group by created_by_region_id, sexe");
        // $s3 = DB::select("SELECT count(id) as nombre_agent, created_by_region_id, sexe FROM agents where created_by_region_id = 3 group by created_by_region_id, sexe");
        // $s4 = DB::select("SELECT count(id) as nombre_agent, created_by_region_id, sexe FROM agents where created_by_region_id = 4 group by created_by_region_id, sexe");
        // $s5 = DB::select("SELECT count(id) as nombre_agent, created_by_region_id, sexe FROM agents where created_by_region_id = 5 group by created_by_region_id, sexe");
        // $s6 = DB::select("SELECT count(id) as nombre_agent, created_by_region_id, sexe FROM agents where created_by_region_id = 6 group by created_by_region_id, sexe");
        // $s7 = DB::select("SELECT count(id) as nombre_agent, created_by_region_id, sexe FROM agents where created_by_region_id = 7 group by created_by_region_id, sexe");
        // $s8 = DB::select("SELECT count(id) as nombre_agent, created_by_region_id, sexe FROM agents where created_by_region_id = 8 group by created_by_region_id, sexe");
        $nombres_par_sexe_regions = DB::select("SELECT count(id) as nombre_agent, sexe, created_by_region_id FROM agents group by sexe, created_by_region_id ORDER by sexe ASC");
        //dd($nombres_par_sexe_regions);
        $tableaux1 = [];
        $donnees1 = [];
        $donnees2 = [];
        $donnees3 = [];
        foreach($nombres_par_sexe_regions as $nombre){
            $tableaux1[] =  $nombre->nombre_agent;
        }
        //dd($tableaux1);
        $donnees1 = array_slice($tableaux1, 0, 8);
        $donnees2 = array_slice($tableaux1, 8, 8);
        $donnees3 = array_slice($tableaux1, 16, 23); 
        //dd($tableaux1 ,$donnees1, $donnees2, $donnees3);

        
        $nombres_agents_SR = [];
        $nombres_agents = [];
        $nombres_agentsR = [];
        $nombres_agentsT = [];
        foreach($nombres_par_sexe as $nombre){
            $nombres_agents[] = $nombre->nombre_agent;
        }
        foreach($nombres_par_regions as $nombre){
            $nombres_agentsR[] = $nombre->nombre_agent;
        }
        $labels = ['Autre', 'Homme', 'Femme'];
        $labels_regions = [];
        foreach($regionsL as $region){
            $labels_regions[] = $region->name;
        }
        $labels_types = [];
        foreach($nombre_par_types as $nombre){
            $nombres_agentsT[] = $nombre->nombre_agent;
        }
        foreach($agents as $agent){
            $labels_types[] = $agent->type;
        }

       // SELECT TIMESTAMPDIFF(YEAR, date_naiss, CURDATE()) AS age, id FROM agents

        $age_agents = DB::select("SELECT TIMESTAMPDIFF(YEAR, date_naiss, CURDATE()) AS age, COUNT(id) as nombre FROM agents GROUP BY age;");
        //dd($age_agents);
        $premiere_tranche = 0;
        $deuxieme_tranche = 0;
        $troisieme_tranche = 0;
        $quatrieme_tranche = 0;
        $cinquieme_tranche = 0;
        $sixieme_tranche = 0;
        $var1 = 0;
        $var2 = 0;
        $var3 = 0;
        $var4 = 0;
        $var5 = 0;
        $var6 = 0;
        foreach($age_agents as $age){
            if($age->age <=20){
                $var1 =  $var1 + $age->nombre;
            }
        
            if($age->age >20 && $age->age <=30){
                $var2 =  $var2 + $age->nombre;
            }

            if($age->age >30 && $age->age <=40){
                $var3 =  $var3 + $age->nombre;
            }

            if($age->age >40 && $age->age <=50){
                $var4 =  $var4 + $age->nombre;
            }

            if($age->age >50 && $age->age <=60){
                $var5 =  $var5 + $age->nombre;
            }

            if($age->age >60){
                $var6 =  $var6 + $age->nombre;
            }
        }
        $premiere_tranche = $var1;
        $deuxieme_tranche = $var2;
        $troisieme_tranche = $var3;
        $quatrieme_tranche = $var4;
        $cinquieme_tranche = $var5;
        $sixieme_tranche = $var6;
        $nombre_agent_tranche_ages = [$premiere_tranche, $deuxieme_tranche, $troisieme_tranche, $quatrieme_tranche, $cinquieme_tranche, $sixieme_tranche];
        $age_tranche_labels = ['0-20', '20-30', '30-40', '40-50', '50-60', '+60'];
        //dd($nombre_agent_tranche_ages, $age_tranche_labels);
        //dd($premiere_tranche, $deuxieme_tranche, $troisieme_tranche, $quatrieme_tranche, $cinquieme_tranche, $sixieme_tranche);
        
        
        return view('home', compact('categories', 'tableaux1', 'donnees1', 'donnees2', 'donnees3', 'nombres_agents_SR', 'nombre_agent_tranche_ages', 'age_tranche_labels', 'nombres_agentsR', 'nombres_agentsT', 'labels_types', 'labels_regions', 'corps', 'positions', 'matrimoniales', 'regions', 'fonctions', 'nombreAgentRetraitable', 'labels', 'nombres_agents'));
    }

    public function nombreAgentRetraitables(Builder $query){
        $months = (Config::first()->age_retraite * 12) - 3;
	    $days = $months * 30;
	    return $query->whereRaw("DATEDIFF(CURDATE(), date_naiss) >= $days")->count();
    }

    public function apiCategory(){
        return response()->json(Corp::find(Input::get('corp_id'))->category);
    }
    public function apiEquivalenceDiplome(){
        return response()->json(Diplome::find(Input::get('diplome_id'))->equivalenceDiplome);
    }
    public function apiNiveauEtude(){
        return response()->json(Diplome::find(Input::get('diplome_id'))->niveauEtude);
    }

    public function apiEchelon(){
        return response()->json(Echelon::where('classe_id', Input::get('classe_id'))->get(['id','name']));
    }

    public function apiIndice(){
        return response()
            ->json(Indice::where('category_id', Input::get('category_id'))
                ->where('classe_id', Input::get('classe_id'))
                ->where('echelon_id', Input::get('echelon_id'))
                ->get(['id','value','salary']));
    }

    public function apiAgent() {
        return response()->json(Agent::with(['grades' => function ($q) {
            $q->with('indice')->latest()->limit(1);
        }])->find( Input::get('agent_id')));
    }

    public function api(Request $request) {
        $model = 'App\\Models\\'.ucfirst($request->model);
        $column = e($request->column);
        return response()->json($model::where("$column", $request->id)->get(['id','name']));

    }

    public function searchAgent(Request $request)
    {
        $search = $request->search;

        if($search == ''){
            $agents = Agent::orderBy('nom','asc')->select('id','matricule','nom','prenom')->limit(10)->get();
        }else{
            $agents = Agent::orderBy('nom','asc')->select('id','matricule','nom','prenom')->where('matricule', 'like', '%' .$search . '%')->orWhere('nom', 'like', '%' .$search . '%')->orWhere('prenom', 'like', '%' .$search . '%')->limit(10)->get();
        }

        $response = array();
        foreach($agents as $agent){
            $response[] = array(
                "id"=>$agent->id,
                "text"=>$agent->matricule.' - '.$agent->nom.' '.$agent->prenom
            );
        }

        echo json_encode($response);
        exit;
    }

    public function getAgent(Request $request) {
        $agent = Agent::select('id','matricule','nom','prenom')->where('id', $request->id)->limit(1)->get()[0];
    return response()->json(['id' => $agent->id, 'text' => $agent->matricule.' - '.$agent->nom.' '.$agent->prenom]);
    }

    public function searchEtablissement(Request $request)
    {
        $search = $request->search;

        if($search == ''){
            $etablissements = Etablissement::select('id','name')->orderBy('name','asc')->limit(10)->get();
        }else{
            $etablissements = Etablissement::select('id','name')->orderBy('name','asc')->where('name', 'like', '%' .$search . '%')->limit(10)->get();
        }

        $response = array();
        foreach($etablissements as $etablissement){
            $response[] = array(
                "id"=>$etablissement->id,
                "text"=>$etablissement->name
            );
        }

        echo json_encode($response);
        exit;
    }

    public function getEtablissement(Request $request) {
        $etablissement = Etablissement::select('id','name')->where('id', $request->id)->limit(1)->get()[0];
        return response()->json(['id' => $etablissement->id, 'text' => $etablissement->name]);
    }
}
