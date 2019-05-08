<?php

namespace App\Http\Controllers;

use App\Forms\EtablissementForm;
use App\Models\Etablissement;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class EtablissementController extends Controller {
    use FormBuilderTrait;

  public function index()
  {
      $form = $this->form(EtablissementForm::class, [
          'method' => 'POST',
          'url' => route('etablissement.store')
      ]);

      $etablissements = Etablissement::with('inspection', 'localite', 'typeEtablissement')->get();
      return view('configurations.etablissements.index', [
          'form' => $form,
          'etablissements' => $etablissements
      ]);

  }


  public function create()
  {

  }


  public function store()
  {

  }


  public function show($id)
  {

  }


  public function edit($id)
  {

  }


  public function update($id)
  {

  }


  public function destroy($id)
  {

  }

}
