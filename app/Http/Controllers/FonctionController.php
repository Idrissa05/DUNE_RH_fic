<?php

namespace App\Http\Controllers;

use App\Forms\FonctionForm;
use App\Models\Fonction;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class FonctionController extends Controller
{
    use FormBuilderTrait;

    public function index() {
        $form = $this->form(FonctionForm::class, [
            'method' => 'POST',
            'url' => route('fonction.store')
        ]);

        $fonctions = Fonction::all();

        return view('configurations.fonctions.index', [
            'form' => $form,
            'fonctions' => $fonctions
        ]);
    }


    public function store() {
        $form = $this->form(FonctionForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
        }

        Fonction::create($form->getRequest()->all());
        return redirect()->route('fonction.index')->with('success', 'Opération effectuée !');
    }

    public function update(Fonction $fonction) {
        $form = $this->form(FonctionForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
        }

        $fonction->update($form->getRequest()->all());
        return redirect()->route('fonction.index')->with('success', 'Opération effectuée !');
    }


    public function destroy(Fonction $fonction) {

        try {

            $fonction->delete();

        }catch (\Exception $exception) {
            return redirect()->route('fonction.index')->with('danger', 'Une erreur est survenue');

        }
        return redirect()->route('fonction.index')->with('success', 'Opération effectuée !');

    }
}
