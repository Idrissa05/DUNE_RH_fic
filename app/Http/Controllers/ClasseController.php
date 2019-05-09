<?php

namespace App\Http\Controllers;

use App\Forms\ClasseForm;
use App\Models\Classe;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class ClasseController extends Controller {
    use FormBuilderTrait;


    public function index()
  {
      $form = $this->form(ClasseForm::class, [
          'method' => 'POST',
          'url' => route('classe.store')
      ]);

      $classes = Classe::all();
      return view('configurations.classes.index', [
          'form' => $form,
          'classes' => $classes
      ]);
  }



  public function store()
  {
      $form = $this->form(ClasseForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      Classe::create($form->getRequest()->all());
      return redirect()->route('classe.index')->with('success', 'Opération effectuée !');

  }



  public function update(Classe $classe)
  {
      $form = $this->form(ClasseForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      $classe->update($form->getRequest()->all());
      return redirect()->route('classe.index')->with('success', 'Opération effectuée !');


  }


  public function destroy(Classe $classe)
  {
      try {
          $classe->delete();
      }catch (\Exception $exception) {
          return redirect()->route('classe.index')->with('danger', 'Suppression impossible');

      }
      return redirect()->route('classe.index')->with('success', 'Opération effectuée !');

  }

}
