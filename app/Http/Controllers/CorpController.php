<?php

namespace App\Http\Controllers;

use App\Forms\CorpForm;
use App\Models\Corp;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class CorpController extends Controller
{
    use FormBuilderTrait;


    public function index() {
        $form = $this->form(CorpForm::class, [
            'method' => 'POST',
            'url' => route('corp.store')
        ]);

        $corps = Corp::with('category')->get();

        return view('configurations.corps.index', [
            'corps' => $corps,
            'form' => $form
        ]);
    }


    public function store() {
        $form = $this->form(CorpForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
        }

        Corp::create($form->getRequest()->all());
        return redirect()->route('corp.index')->with('success', 'Opération effectuée !');
    }

    public function update(Corp $corp) {
        $form = $this->form(CorpForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
        }

        $corp->update($form->getRequest()->all());
        return redirect()->route('corp.index')->with('success', 'Opération effectuée !');
    }


    public function destroy(Corp $corp) {

        try {

            $corp->delete();

        }catch (\Exception $exception) {
            return redirect()->route('corp.index')->with('danger', 'Une erreur est survenue');

        }
        return redirect()->route('corp.index')->with('success', 'Opération effectuée !');

    }
}
