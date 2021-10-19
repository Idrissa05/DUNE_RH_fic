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

    /**
     * Routes des configurations
     */
    Route::group(['middleware' => ['permission:CONSULTER_CONFIGURATION']], function (){
        Route::resource('etablissement', 'EtablissementController');
        Route::resource('category', 'CategoryController');
        Route::resource('classe', 'ClasseController');
        Route::resource('echelon', 'EchelonController');
        Route::resource('region', 'RegionController');
        Route::resource('departement', 'DepartementController');
        Route::resource('inspection', 'InspectionController');
        Route::resource('experience', 'ExperienceController');
        Route::resource('formation', 'FormationController');
        Route::resource('ecoleformation', 'EcoleFormationController');
        Route::resource('diplome', 'DiplomeController');
        Route::resource('niveauetude', 'NiveauEtudeController');
        Route::resource('programmes', 'ProgrammeController');
        Route::resource('equivalencediplome', 'EquivalenceDiplomeController');
        Route::resource('maladie', 'MaladieController');
        Route::resource('matrimoniale', 'MatrimonialeController');
        Route::resource('corp',  'CorpController', ['only' => ['store', 'index', 'update', 'destroy']]);
        Route::resource('cadre',  'CadreController', ['only' => ['store', 'index', 'update', 'destroy']]);
        Route::resource('fonction',  'FonctionController', ['only' => ['store', 'index', 'update', 'destroy']]);
        Route::resource('indice',  'IndiceController', ['only' => ['store', 'index', 'update', 'destroy']]);
        Route::resource('position',  'PositionController', ['only' => ['store', 'index', 'update', 'destroy']]);
        Route::resource('secteurPedagogique',  'SecteurPedagogiqueController', ['only' => ['store', 'index', 'update', 'destroy']]);
        Route::resource('categoryAuxiliaire', 'CategoryAuxiliaireController', ['only' => ['store', 'index', 'update', 'destroy']]);
    });

    Route::resource('conge', 'CongeController');
    Route::resource('conjoint', 'ConjointController');
    Route::resource('deces', 'DeceController');
    Route::resource('enfant', 'EnfantController');
    Route::resource('notation', 'NotationController');
    Route::resource('reclassement', 'ReclassementController');
    Route::resource('retraite', 'RetraiteController');
    Route::resource('typeetablissement', 'TypeEtablissementController');
    Route::resource('avancement', 'AvancementController');


    Route::resource('migration', 'AgentMigrationController', ['only' => ['store', 'index', 'create', 'destroy']]);

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

    Route::get('/api_agent', 'HomeController@apiAgent');
    Route::get('/api_category', 'HomeController@apiCategory');
    Route::get('/api_echelon', 'HomeController@apiEchelon');
    Route::get('/api_indice', 'HomeController@apiIndice');
    Route::get('/api', 'HomeController@api');

    /**
     * Les états
     */
    Route::get('print-etat-nominatif', 'PrintController@etatNominatifs')->name('print.etatnominatif');
    Route::get('print-agents', 'PrintController@agents')->name('print.agents');
    Route::get('/print-retraitables', 'PrintController@retraitables')->name('prints.retraitables');
    Route::get('/print-list', 'PrintController@listParCategorieParSexe')->name('prints.list');
    Route::get('/print-corps', 'PrintController@listParCorp')->name('prints.parcorps');
    Route::get('/print-positions', 'PrintController@listParPosition')->name('prints.parposition');
    Route::get('/print-matrimoniales', 'PrintController@listParMatrimoniale')->name('prints.parmatrimoniale');
    Route::get('/print-infos', 'PrintController@infos')->name('prints.infos');
    Route::get('/print-historique-avancement', 'PrintController@history')->name('prints.history');
    Route::get('/print-par', 'PrintController@par')->name('prints.par');

    /**
     * ACL
     */
    Route::resource('/role', 'RoleController')->except(['show']);

    Route::get('/auto','AvancementController@autoIndex')->name('avancement.auto');
    Route::get('/auto/create/{data}','AvancementController@autoCreate')->name('avancement.auto.create');

    Route::get('/reports', 'reportController@index')->name('report.index');
    Route::post('/reports_show', 'reportController@show')->name('report.show');
    Route::post('/query_store', 'reportController@store')->name('query.store');
    Route::get('/query_get', 'reportController@get');

    // All importations pages (create) & their actions (store)
    Route::get('/imports_page','ImportsController@create')->name('Imports.create');
    Route::post('/imports_store','ImportsController@store')->name('Imports.store');

    // Select2 Ajax Source
    Route::get('get_agent/{id}', 'HomeController@getAgent')->name('agent.get');
    Route::post('/search-agent/', 'HomeController@searchAgent')->name('agent.search');
    Route::get('get_etablissement/{id}', 'HomeController@getEtablissement')->name('etablissement.get');
    Route::post('/search-etablissement/', 'HomeController@searchEtablissement')->name('etablissement.search');
    Route::get('/informations/agent', 'AgentController@agent_information')->name('agent_information');

    // Acces enseignant
    Route::get('/inscription-agent', 'AccesAgentController@create')->name('inscription.agent');
    Route::post('/inscription_agent', 'AccesAgentController@store')->name('inscription_agent');
    Route::post('/chech-confirmation-code', 'AccesAgentController@chech_confirmation_code')->name('chech_confirmation_code');
});

    

