<?php

namespace App\Http\Controllers;

use App\Forms\LocaliteForm;
use App\Models\Localite;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class LocaliteController extends Controller {
    use FormBuilderTrait;

  public function index()
  {
      $form = $this->form(LocaliteForm::class, [
          'method' => 'POST',
          'url' => route('localite.store')
      ]);

      $localites = Localite::all();
      return view('configurations.localites.index', [
          'form' => $form,
          'localites' => $localites
      ]);

  }


  public function store()
  {
      $form = $this->form(LocaliteForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      Localite::create($form->getRequest()->all());
      return redirect()->route('localite.index')->with('success', 'Opération effectuée !');

  }



  public function update(Localite $localite)
  {
      $form = $this->form(LocaliteForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      $localite->update($form->getRequest()->all());
      return redirect()->route('localite.index')->with('success', 'Opération effectuée !');

  }


  public function destroy(Localite $localite)
  {
      try {
          $localite->delete();
      }catch (\Exception $exception) {
          return redirect()->route('localite.index')->with('danger', 'Suppression impossible');
      }
      return redirect()->route('localite.index')->with('success', 'Opération effectuée !');


  }

}
