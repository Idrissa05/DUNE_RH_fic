<?php

namespace App\Http\Controllers;

use App\Forms\SecteurPedagogiqueForm;
use App\Models\SecteurPedagogique;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class SecteurPedagogiqueController extends Controller
{
    use FormBuilderTrait;

    public function index() {

        $form = $this->form(SecteurPedagogiqueForm::class, [
            'method' => 'POST',
            'url' => route('secteurPedagogique.store')
        ]);

        $secteurs = SecteurPedagogique::with('inspection')->get();

        return view('configurations.secteur_pedagogiques.index', [
            'form' => $form,
            'secteurPedagogiques' => $secteurs
        ]);
    }

    public function store()
    {
        $form = $this->form(SecteurPedagogiqueForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
        }

        SecteurPedagogique::create($form->getRequest()->all());
        return redirect()->route('secteurPedagogique.index')->with('success', 'Opération effectuée !');

    }


    public function update(SecteurPedagogique $secteurPedagogique)
    {
        $form = $this->form(SecteurPedagogiqueForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
        }

        $secteurPedagogique->update($form->getRequest()->all());
        return redirect()->route('secteurPedagogique.index')->with('success', 'Opération effectuée !');

    }


    public function destroy(SecteurPedagogique $secteurPedagogique)
    {
        try {
            $secteurPedagogique->delete();
        }catch (\Exception $exception) {
            return redirect()->route('secteurPedagogique.index')->with('danger', 'Suppression impossible');
        }
        return redirect()->route('secteurPedagogique.index')->with('success', 'Opération effectuée !');

    }
}
