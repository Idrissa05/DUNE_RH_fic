<?php
namespace App\Http\Controllers;

use App\Forms\NiveauEtudeForm;
use App\Models\NiveauEtude;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class NiveauEtudeController extends Controller {
    use FormBuilderTrait;

  public function index()
  {
      $form = $this->form(NiveauEtudeForm::class, [
          'method' => 'POST',
          'url' => route('niveauetude.store')
      ]);

      $niveaux = NiveauEtude::all();

      return view('configurations.niveau_etudes.index', [
          'form' => $form,
          'niveaux' => $niveaux
      ]);

  }

  public function store()
  {
      $form = $this->form(NiveauEtudeForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      NiveauEtude::create($form->getRequest()->all());
      return redirect()->route('niveauetude.index')->with('success', 'Opération effectuée !');

  }


  public function update(NiveauEtude $niveauetude)
  {
      $form = $this->form(NiveauEtudeForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      $niveauetude->update($form->getRequest()->all());
      return redirect()->route('niveauetude.index')->with('success', 'Opération effectuée !');

  }


  public function destroy(NiveauEtude $niveauetude)
  {
      try {
          $niveauetude->delete();
      }catch (\Exception $exception) {
          return redirect()->route('niveauetude.index')->with('danger', 'Suppression Impossible !');

      }
      return redirect()->route('niveauetude.index')->with('success', 'Opération effectuée !');

  }

}
