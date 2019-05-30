<?php

namespace App\Http\Controllers;
use App\Models\Corp;
use App\Models\Echelon;
use App\Models\Indice;
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
        return view('home');
    }

    public function apiCategory(){
        return response()->json(Corp::find(Input::get('corp_id'))->category);
    }

    public function apiEchelon(){
        return response()->json(Echelon::where('classe_id', Input::get('classe_id'))->get(['id','name']));
    }

    public function apiIndice(){
        return response()->json(Indice::where('category_id', Input::get('category_id'))->where('classe_id', Input::get('classe_id'))->where('echelon_id', Input::get('echelon_id'))->get(['id','value','salary']));
    }
}
