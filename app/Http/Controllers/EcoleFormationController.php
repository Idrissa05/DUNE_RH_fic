<?php

namespace App\Http\Controllers;

use App\Forms\EcoleFormationForm;
use App\Models\EcoleFormation;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class EcoleFormationController extends Controller {
    use FormBuilderTrait;

  public function index()
  {
      $form = $this->form(EcoleFormationForm::class, [
          'method' => 'POST',
          'url' => route('ecoleformation.store')
      ]);

      $ecoles = EcoleFormation::all();
      return view('configurations.ecole_formations.index', [
          'form' => $form,
          'ecoles' => $ecoles
      ]);

  }


  public function store()
  {
      $form = $this->form(EcoleFormationForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput();
      }

      EcoleFormation::create($form->getRequest()->all());
      return redirect()->route('ecoleformation.index');
  }


  public function update(EcoleFormation $ecoleformation)
  {
      $form = $this->form(EcoleFormationForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput();
      }

      $ecoleformation->update($form->getRequest()->all());
      return redirect()->route('ecoleformation.index');

  }


  public function destroy(EcoleFormation $ecoleformation)
  {
      try {
          $ecoleformation->delete();

      }catch (\Exception $exception) {
          return redirect()->route('ecoleformation.index')->with('danger', 'Suppression impossible');
      }
      return redirect()->route('ecoleformation.index')->with('succes', 'Opération effectuée !');

  }

}
