<?php

namespace App\Http\Controllers;

use App\Forms\IndiceForm;
use App\Models\Indice;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class IndiceController extends Controller
{
    use FormBuilderTrait;


    public function index() {
        $form = $this->form(IndiceForm::class, [
            'method' => 'POST',
            'url' => route('indice.store')
        ]);

        $indices = Indice::with('category', 'classe', 'echelon')->get();

        return view('configurations.indices.index', [
            'form' => $form,
            'indices' => $indices
        ]);
    }


    public function store()
    {
        $form = $this->form(IndiceForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
        }

        Indice::create($form->getRequest()->all());
        return redirect()->route('indice.index')->with('success', 'Opération effectuée !');

    }


    public function update(Indice $indice)
    {
        $form = $this->form(IndiceForm::class);
        $request = $form->getRequest();

        $this->validate($request, [
            'salary' => 'required|numeric',
            'value' => 'required|numeric'
        ]);

        $indice->update([
            'salary' => $request->salary,
            'value' => $request->value
        ]);
        return redirect()->route('indice.index')->with('success', 'Opération effectuée !');

    }


    public function destroy(Indice $indice)
    {
        try {
            $indice->delete();
        }catch (\Exception $exception) {
            return redirect()->route('indice.index')->with('danger', 'Suppression impossible');
        }
        return redirect()->route('indice.index')->with('success', 'Opération effectuée !');

    }

}
