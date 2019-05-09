<?php

namespace App\Http\Controllers;

use App\Forms\EchelonForm;
use App\Models\Echelon;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class EchelonController extends Controller {
    use FormBuilderTrait;

  public function index()
  {
      $form = $this->form(EchelonForm::class, [
          'method' => 'POST',
          'url' => route('echelon.store')
      ]);

      $echelons = Echelon::all();
      return view('configurations.echelons.index', [
          'form' => $form,
          'echelons' => $echelons
      ]);

  }


  public function store()
  {
      $form = $this->form(EchelonForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      Echelon::create($form->getRequest()->all());
      return redirect()->route('echelon.index')->with('success', 'Opération effectuée !');

  }


  public function update(Echelon $echelon)
  {
      $form = $this->form(EchelonForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      $echelon->update($form->getRequest()->all());
      return redirect()->route('echelon.index')->with('success', 'Opération effectuée !');

  }


  public function destroy(Echelon $echelon)
  {
      try {
          $echelon->delete();
      }catch (\Exception $exception) {
          return redirect()->route('echelon.index')->with('danger', 'Suppression impossible');
      }
      return redirect()->route('echelon.index')->with('success', 'Opération effectuée !');

  }

}
