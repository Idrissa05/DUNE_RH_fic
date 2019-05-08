<?php

namespace App\Http\Controllers;

use App\Forms\CategorieForm;
use App\Models\Category;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class CategoryController extends Controller {
    use FormBuilderTrait;

  public function index()
  {
      $form = $this->form(CategorieForm::class, [
          'method' => 'POST',
          'url' => route('category.store')
      ]);
      $categories = Category::all();
      return view('configurations.categories.index', [
          'categories' => $categories,
          'form' => $form
      ]);

  }


  public function store()
  {
      $form = $this->form(CategorieForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput();
      }

      Category::create($form->getRequest()->all());
      return redirect()->route('category.index');

  }

  public function update(Category $category)
  {
      $form = $this->form(CategorieForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput();
      }

      $category->update($form->getRequest()->all());
      return redirect()->route('category.index');
  }


  public function destroy(Category $category)
  {
      try {
          $category->delete();
      }catch (\Exception $exception) {
          return redirect()->back()->with('danger', 'Impossible de supprimer la catégorie');
      }

      return redirect()->back()->with('success', 'Opération effectuée !');


  }

}
