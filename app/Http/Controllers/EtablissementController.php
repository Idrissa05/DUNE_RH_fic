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

      $etablissements = Etablissement::with('secteurPedagogique', 'typeEtablissement')->get();
      return view('configurations.etablissements.index', [
          'form' => $form,
          'etablissements' => $etablissements
      ]);

  }


  public function store()
  {
      $form = $this->form(EtablissementForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      Etablissement::create($form->getRequest()->all());
      return redirect()->route('etablissement.index')->with('success', 'Opération effectuée !');

  }


  public function update(Etablissement $etablissement)
  {
      $form = $this->form(EtablissementForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      $etablissement->update($form->getRequest()->all());
      return redirect()->route('etablissement.index')->with('success', 'Opération effectuée !');
  }


  public function destroy(Etablissement $etablissement)
  {
      try {
          $etablissement->delete();
      }catch (\Exception $exception) {
          return redirect()->route('etablissement.index')->with('danger', 'Suppression impossible');
      }
      return redirect()->route('etablissement.index')->with('success', 'Opération effectuée !');

  }

}
