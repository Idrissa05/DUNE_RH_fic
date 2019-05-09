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
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      TypeEtablissement::create($form->getRequest()->all());
      return redirect()->route('typeetablissement.index')->with('success', 'Opération effectuée !');

  }



  public function update(TypeEtablissement $typeetablissement)
  {
      $form = $this->form(TypeEtablissementForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      $typeetablissement->update($form->getRequest()->all());
      return redirect()->route('typeetablissement.index')->with('success', 'Opération effectuée !');

  }


  public function destroy(TypeEtablissement $typeetablissement)
  {
      try {
          $typeetablissement->delete();
      }catch (\Exception $exception) {
          return redirect()->route('typeetablissement.index')->with('danger', 'Suppression impossible');

      }
      return redirect()->route('typeetablissement.index')->with('success', 'Opération effectuée !');

  }

}
