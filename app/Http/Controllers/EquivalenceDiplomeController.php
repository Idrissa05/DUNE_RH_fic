<?php

namespace App\Http\Controllers;

use App\Forms\EquivalenceDiplomeForm;
use App\Models\EquivalenceDiplome;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class EquivalenceDiplomeController extends Controller {
    use FormBuilderTrait;

  public function index()
  {
      $form = $this->form(EquivalenceDiplomeForm::class, [
          'method' => 'POST',
          'url' => route('equivalencediplome.store')
      ]);

      $equivalences = EquivalenceDiplome::all();

      return view("configurations.equivalence_diplomes.index", [
          'form' => $form,
          'equivalences' => $equivalences
      ]);

  }

  public function store()
  {
      $form = $this->form(EquivalenceDiplomeForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      EquivalenceDiplome::create($form->getRequest()->all());
      return redirect()->route('equivalencediplome.index')->with('success', 'Opération effectuée !');

  }


  public function update(EquivalenceDiplome $equivalencediplome)
  {
      $form = $this->form(EquivalenceDiplomeForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      $equivalencediplome->update($form->getRequest()->all());
      return redirect()->route('equivalencediplome.index')->with('success', 'Opération effectuée !');

  }


  public function destroy(EquivalenceDiplome $equivalencediplome)
  {
      try {
          $equivalencediplome->delete();
      }catch (\Exception $exception) {
          return redirect()->route('equivalencediplome.index')->with('danger', 'Suppression impossible !');
      }
      return redirect()->route('equivalencediplome.index')->with('success', 'Opération effectuée !');


  }

}
