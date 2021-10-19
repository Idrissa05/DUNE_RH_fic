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
        $categories = Category::orderBy('name')->get()->toArray();
        $categories = array_merge($categories, CategoryAuxiliaire::orderBy('name')->get()->toArray());
        //$agents = Agent::orderBy('matricule')->take(1000)->get();
        $corps = Corp::orderBy('name')->get();
        $positions = Position::orderBy('name')->get();
        $matrimoniales = Matrimoniale::orderBy('name')->get();
        $fonctions = Fonction::orderBy('name')->get();
        $regions = Region::orderBy('name')->get();
        return view('home', compact('categories', 'corps', 'positions', 'matrimoniales', 'regions', 'fonctions'));
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
