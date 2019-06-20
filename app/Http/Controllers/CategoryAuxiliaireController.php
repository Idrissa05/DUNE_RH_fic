<?php

namespace App\Http\Controllers;

use App\Forms\CategoryAuxiliaireForm;
use App\Models\CategoryAuxiliaire;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class CategoryAuxiliaireController extends Controller {
    use FormBuilderTrait;

  public function index()
  {
      $form = $this->form(CategoryAuxiliaireForm::class, [
          'method' => 'POST',
          'url' => route('categoryAuxiliaire.store')
      ]);
      $categories = CategoryAuxiliaire::all();
      return view('configurations.categories_auxiliaires.index', [
          'categories' => $categories,
          'form' => $form
      ]);

  }

  public function store()
  {
      $form = $this->form(CategoryAuxiliaireForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      CategoryAuxiliaire::create($form->getRequest()->all());
      return redirect()->route('categoryAuxiliaire.index')->with('success', 'Opération effectuée !');

  }

  public function update(CategoryAuxiliaire $categoryAuxiliaire)
  {
      $form = $this->form(CategoryAuxiliaireForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      $categoryAuxiliaire->update($form->getRequest()->all());
      return redirect()->route('categoryAuxiliaire.index')->with('success', 'Opération effectuée !');
  }


  public function destroy(CategoryAuxiliaire $categoryAuxiliaire)
  {
      try {
          $categoryAuxiliaire->delete();
      }catch (\Exception $exception) {
          return redirect()->back()->with('danger', 'Impossible de supprimer la catégorie');
      }

      return redirect()->back()->with('success', 'Opération effectuée !');


  }

}
