<?php

namespace App\Http\Controllers;
use App\Models\Agent;
use App\Models\Category;
use App\Models\Corp;
use App\Models\Departement;
use App\Models\Echelon;
use App\Models\Fonction;
use App\Models\Indice;
use App\Models\Inspection;
use App\Models\Matrimoniale;
use App\Models\Position;
use App\Models\Region;
use App\Models\SecteurPedagogique;
use Illuminate\Http\Request;
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
        $categories = Category::orderBy('name')->get();
        $agents = Agent::orderBy('matricule')->get();
        $corps = Corp::orderBy('name')->get();
        $positions = Position::orderBy('name')->get();
        $matrimoniales = Matrimoniale::orderBy('name')->get();
        $fonctions = Fonction::orderBy('name')->get();
        $regions = Region::orderBy('name')->get();
        return view('home', compact('categories', 'agents', 'corps', 'positions', 'matrimoniales', 'regions', 'fonctions'));
    }

    public function apiCategory(){
        return response()->json(Corp::find(Input::get('corp_id'))->category);
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

    public function api(Request $request) {
        $model = 'App\\Models\\'.ucfirst($request->model);
        $column = e($request->column);
        return response()->json($model::where("$column", $request->id)->get(['id','name']));

    }
}
