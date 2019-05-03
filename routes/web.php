<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('agent', 'AgentController');
Route::resource('affectation', 'AffectationController');
Route::resource('etablissement', 'EtablissementController');
Route::resource('category', 'CategoryController');
Route::resource('classe', 'ClasseController');
Route::resource('echelon', 'EchelonController');
Route::resource('conge', 'CongeController');
Route::resource('conjoint', 'ConjointController');
Route::resource('deces', 'DeceController');
Route::resource('enfant', 'EnfantController');
Route::resource('region', 'RegionController');
Route::resource('departement', 'DepartementController');
Route::resource('inspection', 'InspectionController');
Route::resource('localite', 'LocaliteController');
Route::resource('experience', 'ExperienceController');
Route::resource('formation', 'FormationController');
Route::resource('ecoleformation', 'EcoleFormationController');
Route::resource('diplome', 'DiplomeController');
Route::resource('niveauetude', 'NiveauEtudeController');
Route::resource('equivalencediplome', 'EquivalenceDiplomeController');
Route::resource('maladie', 'MaladieController');
Route::resource('matrimoniale', 'MatrimonialeController');
Route::resource('notation', 'NotationController');
Route::resource('reclassement', 'ReclassementController');
Route::resource('retraite', 'RetraiteController');
Route::resource('typeetablissement', 'TypeEtablissementController');
