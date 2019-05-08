<?php

namespace App\Http\Controllers;

use App\Forms\FormationForm;
use App\Models\Formation;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class FormationController extends Controller {
    use FormBuilderTrait;

  public function index()
  {
      $form = $this->form(FormationForm::class, [
          'method' => 'POST',
          'url' => route('formation.store')
      ]);

      $formations = Formation::all();
      return view('configurations.formations.index', [
          'form' => $form,
          'formations' => $formations
      ]);

  }


  public function store()
  {
      $form = $this->form(FormationForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput();
      }

      Formation::create($form->getRequest()->all());
      return redirect()->route('formation.index');

  }


  public function update(Formation $formation)
  {
      $form = $this->form(FormationForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput();
      }

      $formation->update($form->getRequest()->all());
      return redirect()->route('formation.index');

  }


  public function destroy(Formation $formation)
  {
      try {
          $formation->delete();

      }catch (\Exception $exception) {
          return redirect()->route('formation.index')->with('danger', 'Suppression Impossible !');
      }
      return redirect()->route('formation.index')->with('success', 'Opération effectuée !');

  }

}
