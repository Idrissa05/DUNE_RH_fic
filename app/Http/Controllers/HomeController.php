<?php

namespace App\Http\Controllers;

use App\Forms\ClasseForm;
use App\Forms\EchelonForm;
use App\Forms\EtablissementForm;
use App\Forms\FormationForm;
use App\Forms\InspectionForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(FormBuilder  $formBuilder)
    {
        $form = $formBuilder->create(FormationForm::class, [
            'method' => 'POST',
            'url' => ''
        ]);
        return view('home', compact("form"));
    }
}
