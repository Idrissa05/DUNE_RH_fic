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
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
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
    Route::resource('avancement', 'AvancementController');

    Route::resource('corp',  'CorpController', ['only' => ['store', 'index', 'update', 'destroy']]);
    Route::resource('cadre',  'CadreController', ['only' => ['store', 'index', 'update', 'destroy']]);
    Route::resource('fonction',  'FonctionController', ['only' => ['store', 'index', 'update', 'destroy']]);
    Route::resource('indice',  'IndiceController', ['only' => ['store', 'index', 'update', 'destroy']]);
    Route::resource('position',  'PositionController', ['only' => ['store', 'index', 'update', 'destroy']]);
    Route::resource('secteurPedagogique',  'SecteurPedagogiqueController', ['only' => ['store', 'index', 'update', 'destroy']]);

    Route::get('agent-maladie', 'AgentMaladieController@index')->name('agent-maladie.index');
    Route::post('agent-maladie', 'AgentMaladieController@store')->name('agent-maladie.store');
    Route::get('agent-maladie/{agent}', 'AgentMaladieController@show')->name('agent-maladie.show');
    Route::delete('agent-maladie/{agent}/{maladie}', 'AgentMaladieController@destroy')->name('agent-maladie.destroy');

    Route::get('agent-position', 'AgentPositionController@index')->name('agent-position.index');
    Route::post('agent-position', 'AgentPositionController@store')->name('agent-position.store');
    Route::get('agent-position/{agent}', 'AgentPositionController@show')->name('agent-position.show');
    Route::delete('agent-position/{agent}/{position}', 'AgentPositionController@destroy')->name('agent-position.destroy');

    Route::get('agent-matrimoniale', 'AgentMatrimonialeController@index')->name('agent-matrimoniale.index');
    Route::post('agent-matrimoniale', 'AgentMatrimonialeController@store')->name('agent-matrimoniale.store');


    Route::get('/configs', 'ConfigController@index')->name('config.index');
    Route::put('/configs', 'ConfigController@update')->name('config.update');

    Route::resource('users', 'UsersController', ['only' => ['index', 'update', 'destroy']]);
    Route::get('/change-password', 'UsersController@changePassword')->name('change.password');
    Route::post('/change-password', 'UsersController@changePassword');


    Route::get('/api_category', 'HomeController@apiCategory');
    Route::get('/api_echelon', 'HomeController@apiEchelon');
    Route::get('/api_indice', 'HomeController@apiIndice');

    /**
     * Les états
     */
    Route::get('print-agents', 'PrintController@agents')->name('print.agents');

    Route::get('/auto','AvancementController@autoIndex')->name('avancement.auto');
    Route::get('/auto/create/{data}','AvancementController@autoCreate')->name('avancement.auto.create');
});
