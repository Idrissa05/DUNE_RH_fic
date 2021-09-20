<?php

namespace App\Http\Controllers;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use App\Forms\ProgrammeForm;
use App\Models\Programme;


use Illuminate\Http\Request;

class ProgrammeController extends Controller
{
    use FormBuilderTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $form = $this->form(ProgrammeForm::class, [
          'method' => 'POST',
          'url' => route('programmes.store')
      ]);

      $programmes = Programme::all();

      return view('configurations.programmes.index', [
          'form' => $form,
          'programmes' => $programmes
      ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
      $form = $this->form(ProgrammeForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      Programme::create($form->getRequest()->all());
      return redirect()->route('programmes.index')->with('success', 'Opération effectuée !');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Programme $programme)
    {
      $form = $this->form(ProgrammeForm::class);

      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
      }

      $programme->update($form->getRequest()->all());
      return redirect()->route('programmes.index')->with('success', 'Opération effectuée !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programme $programme)
    {
      try {
          $programme->delete();
      }catch (\Exception $exception) {
          return redirect()->route('programmes.index')->with('danger', 'Suppression Impossible !');

      }
      return redirect()->route('programmes.index')->with('success', 'Opération effectuée !');

    }
}
