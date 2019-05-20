<?php

namespace App\Http\Controllers;

use App\Forms\CongeForm;
use App\Models\Conge;
use DemeterChain\C;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class CongeController extends Controller {
    use FormBuilderTrait;


  public function index()
  {
      $form = $this->form(CongeForm::class, [
          'method' => 'POST',
          'url' => route('conge.store')
      ]);

      $conges = Conge::with('agent')->get();

      return view('pages.agents.conges.index', [
          'form' => $form,
          'conges' => $conges
      ]);
  }

  public function store()
  {
      $form = $this->form(CongeForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      Conge::create($form->getRequest()->all());
      return redirect()->route('conge.index')->with('success', 'Opération effectuée !');

  }


  public function update(Conge $conge)
  {
      $form = $this->form(CongeForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      $conge->update($form->getRequest()->all());
      return redirect()->route('conge.index')->with('success', 'Opération effectuée !');

  }


  public function destroy(Conge $conge)
  {
      try {
          $conge->delete();
      }catch (\Exception $exception) {
          return redirect()->route('conge.index')->with('danger', "Une erreur est survenue !\n".$exception->getMessage());
      }

  }

}
