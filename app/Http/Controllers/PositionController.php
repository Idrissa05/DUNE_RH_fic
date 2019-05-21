<?php

namespace App\Http\Controllers;

use App\Forms\PositionForm;
use App\Models\Position;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class PositionController extends Controller
{
    use FormBuilderTrait;

    public function index() {

        $form = $this->form(PositionForm::class, [
            'method' => 'POST',
            'url' => route('position.store')
        ]);

        $positions = Position::all();

        return view('configurations.positions.index', [
            'form' => $form,
            'positions' => $positions
        ]);
    }

    public function store()
    {
        $form = $this->form(PositionForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
        }

        Position::create($form->getRequest()->all());
        return redirect()->route('position.index')->with('success', 'Opération effectuée !');

    }


    public function update(Position $position)
    {
        $form = $this->form(PositionForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
        }

        $position->update($form->getRequest()->all());
        return redirect()->route('position.index')->with('success', 'Opération effectuée !');

    }


    public function destroy(Position $position)
    {
        try {
            $position->delete();
        }catch (\Exception $exception) {
            return redirect()->route('position.index')->with('danger', 'Suppression impossible');
        }
        return redirect()->route('position.index')->with('success', 'Opération effectuée !');

    }
}
