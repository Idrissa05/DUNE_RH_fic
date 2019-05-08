<?php

namespace App\Http\Controllers;

use App\Forms\MatrimonialeForm;
use App\Models\Matrimoniale;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class MatrimonialeController extends Controller {
    use FormBuilderTrait;

  public function index()
  {
      $form = $this->form(MatrimonialeForm::class, [
          'method' => 'POST',
          'url' => route('matrimoniale.store')
      ]);

      $matrimoniales = Matrimoniale::all();

      return view('configurations.matrimoniales.index', [
          'form' => $form,
          'matrimoniales' => $matrimoniales
      ]);

  }


  public function store()
  {
      $form = $this->form(MatrimonialeForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput();
      }

      Matrimoniale::create($form->getRequest()->all());
      return redirect()->route('matrimoniale.index');

  }


  public function update(Matrimoniale $matrimoniale)
  {
      $form = $this->form(MatrimonialeForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput();
      }

      $matrimoniale->update($form->getRequest()->all());
      return redirect()->route('matrimoniale.index');

  }


  public function destroy(Matrimoniale $matrimoniale)
  {
      try {
          $matrimoniale->delete();
      }catch (\Exception $exception) {
          return redirect()->route('matrimoniale.index')->with('danger', 'Suppression Impossible !');
      }
      return redirect()->route('matrimoniale.index')->with('success', 'Opération effectuée !');

  }

}
