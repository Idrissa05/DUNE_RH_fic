<?php

namespace App\Http\Controllers;

use App\Config;
use App\Forms\ConfigForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class ConfigController extends Controller
{
    use FormBuilderTrait;


    public function index() {

        $form = $this->form(ConfigForm::class, [
            'method' => 'PUT',
            'url' => route('config.update'),
            'model' => Config::first()
        ]);

        return view('system.index', [
            'form' => $form
        ]);
    }

    public function update() {
        $form = $this->form(ConfigForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
        }
        $config = Config::first();

        $config->update($form->getRequest()->all());
        return redirect()->route('config.index')->with('success', 'Opération effectuée !');
    }
}
