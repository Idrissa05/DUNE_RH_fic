<?php

namespace App\Http\Controllers;

use App\Forms\TypeEtablissementForm;
use App\Models\TypeEtablissement;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class TypeEtablissementController extends Controller {
    use FormBuilderTrait;


  public function index()
  {
      $form = $this->form(TypeEtablissementForm::class, [
          'method' => 'POST',
          'url' => route('typeetablissement.store')
      ]);

      $typeEtablissements = TypeEtablissement::all();
      return view('configurations.type_etablissements.index', [
          'form' => $form,
          'typeEtablissements' => $typeEtablissements
      ]);

  }


  public function store()
  {
      $form = $this->form(TypeEtablissementForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput();
      }

      TypeEtablissement::create($form->getRequest()->all());
      return redirect()->route('typeetablissement.index');

  }



  public function update(TypeEtablissement $typeetablissement)
  {
      $form = $this->form(TypeEtablissementForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput();
      }

      $typeetablissement->update($form->getRequest()->all());
      return redirect()->route('typeetablissement.index');

  }


  public function destroy(TypeEtablissement $typeetablissement)
  {
      try {
          $typeetablissement->delete();
      }catch (\Exception $exception) {
          return redirect()->route('typeetablissement.index')->with('danger', 'Suppression impossible');

      }
      return redirect()->route('typeetablissement.index')->with('Opération effectuée !');

  }

}
