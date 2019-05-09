<?php

namespace App\Http\Controllers;

use App\Forms\InspectionForm;
use App\Models\Inspection;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class InspectionController extends Controller {
    use FormBuilderTrait;

  public function index()
  {
      $form = $this->form(InspectionForm::class, [
          'method' => 'POST',
          'url' => route('inspection.store')
      ]);

      $inspections = Inspection::with('departement')->get();

      return view('configurations.inspections.index', [
          'form' => $form,
          'inspections' => $inspections
      ]);



  }



  public function store()
  {
      $form = $this->form(InspectionForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      Inspection::create($form->getRequest()->all());
      return redirect()->route('inspection.index')->with('success', 'Opération effectuée !');

  }



  public function update(Inspection $inspection)
  {
      $form = $this->form(InspectionForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      $inspection->update($form->getRequest()->all());
      return redirect()->route('inspection.index')->with('success', 'Opération effectuée !');
  }


  public function destroy(Inspection $inspection)
  {
      try {
          $inspection->delete();
      }catch (\Exception $exception) {
          return redirect()->route('inspection.index')->with('danger', 'Suppression impossible !');

      }
      return redirect()->route('inspection.index')->with('success', 'Opération effectuée !');

  }

}
