<?php

namespace App\Http\Controllers;

use App\Forms\CadreForm;
use App\Models\Cadre;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class CadreController extends Controller
{
    use FormBuilderTrait;


    public function index() {
        $form = $this->form(CadreForm::class, [
            'method' => 'POST',
            'url' => route('cadre.store')
        ]);

        $cadres = Cadre::all();

        return view('configurations.cadres.index', [
            'form' => $form,
            'cadres' => $cadres
        ]);
    }

    public function store() {
        $form = $this->form(CadreForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
        }

        Cadre::create($form->getRequest()->all());
        return redirect()->route('cadre.index')->with('success', 'Opération effectuée !');
    }

    public function update(Cadre $cadre) {
        $form = $this->form(CadreForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
        }

        $cadre->update($form->getRequest()->all());
        return redirect()->route('cadre.index')->with('success', 'Opération effectuée !');
    }


    public function destroy(Cadre $cadre) {

        try {

            $cadre->delete();

        }catch (\Exception $exception) {
            return redirect()->route('cadre.index')->with('danger', 'Une erreur est survenue');

        }
        return redirect()->route('cadre.index')->with('success', 'Opération effectuée !');

    }
}
