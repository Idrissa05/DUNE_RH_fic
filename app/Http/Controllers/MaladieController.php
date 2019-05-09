<?php

namespace App\Http\Controllers;

use App\Forms\MaladieForm;
use App\Models\Maladie;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class MaladieController extends Controller {
    use FormBuilderTrait;

  public function index()
  {
      $form = $this->form(MaladieForm::class, [
          'method' => 'POST',
          'url' => route('maladie.store')
      ]);

      $maladies = Maladie::all();

      return view('configurations.maladies.index', [
          'form' => $form,
          'maladies' => $maladies
      ]);

  }


  public function store()
  {
      $form = $this->form(MaladieForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      Maladie::create($form->getRequest()->all());
      return redirect()->route('maladie.index')->with('success', 'Opération effectuée !');

  }


  public function update(Maladie $maladie)
  {
      $form = $this->form(MaladieForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      $maladie->update($form->getRequest()->all());
      return redirect()->route('maladie.index')->with('success', 'Opération effectuée !');

  }


  public function destroy(Maladie $maladie)
  {
      try {
          $maladie->delete();
      }catch (\Exception $exception) {
          return redirect()->route('maladie.index')->with('danger', 'Suppression impossible !');

      }
      return redirect()->route('maladie.index')->with('success', 'Opération effectuée !');

  }

}
