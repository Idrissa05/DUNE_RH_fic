<?php

namespace App\Http\Controllers;

use App\Forms\DiplomeForm;
use App\Models\Diplome;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class DiplomeController extends Controller {
    use FormBuilderTrait;

    public function index()
    {
        $form = $this->form(DiplomeForm::class, [
            'method' => 'POST',
            'url' => route('diplome.store')
        ]);

        $diplomes = Diplome::all();
        return view('configurations.diplomes.index', [
            'form' => $form,
            'diplomes' => $diplomes
        ]);

    }


    public function store()
    {
        $form = $this->form(DiplomeForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
        }

        Diplome::create($form->getRequest()->all());
        return redirect()->route('diplome.index')->with('success', 'Opération effectuée !');

    }



    public function update(Diplome $diplome)
    {
        $form = $this->form(DiplomeForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
        }

        $diplome->update($form->getRequest()->all());
        return redirect()->route('diplome.index')->with('success', 'Opération effectuée !');

    }


    public function destroy(Diplome $diplome)
    {
        try {
            $diplome->delete();
        }catch (\Exception $exception) {
            return redirect()->route('diplome.index')->with('danger', 'Suppression impossible');
        }
        return redirect()->route('diplome.index')->with('success', 'Opération effectuée !');


    }

}
