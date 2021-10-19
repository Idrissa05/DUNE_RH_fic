<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Forms\TypeEnseignementForm;
use App\Models\TypeEnseignement;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class TypeEnseignementController extends Controller
{
    use FormBuilderTrait;

    public function index()
  {
      $form = $this->form(TypeEnseignementForm::class, [
          'method' => 'POST',
          'url' => route('type_enseignement.store')
      ]);

      $type_enseignements = TypeEnseignement::all();

      return view('configurations.type_enseignements.index', [
          'form' => $form,
          'type_enseignements' => $type_enseignements
      ]);

  }

  public function store()
  {
      $form = $this->form(TypeEnseignementForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      TypeEnseignement::create($form->getRequest()->all());
      return redirect()->route('type_enseignement.index')->with('success', 'Opération effectuée !');

  }

  public function update(TypeEnseignement $type_enseignement)
  {
      $form = $this->form(TypeEnseignement::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      $type_enseignement->update($form->getRequest()->all());
      return redirect()->route('type_enseignement.index')->with('success', 'Opération effectuée !');

  }


  public function destroy(TypeEnseignement $type_enseignement)
  {
      try {
          $type_enseignement->delete();
      }catch (\Exception $exception) {
          return redirect()->route('type_enseignement.index')->with('danger', 'Suppression Impossible !');
      }
      return redirect()->route('type_enseignement.index')->with('success', 'Opération effectuée !');

  }
}
