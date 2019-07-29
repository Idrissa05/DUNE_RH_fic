<?php

namespace App\Http\Controllers;

use App\Forms\ExperienceForm;
use App\Models\Agent;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Yajra\DataTables\Facades\DataTables;

class ExperienceController extends Controller {
    use FormBuilderTrait;

    public function __construct()
    {
        $this->middleware('permission:CONSULTER_EXPERIENCE');
        $this->middleware('permission:EDITER_EXPERIENCE')->only('store', 'update');
        $this->middleware('permission:SUPPRIMER_EXPERIENCE')->only('destroy');
    }


    public function index(Request $request)
    {
        if($request->ajax()) {
            return $this->getData();
        }
        return view('pages.agents.experiences.index');

    }


    public function create()
    {
        $experience = new Experience();

        $form = $this->form(ExperienceForm::class, [
            'method' => 'POST',
            'url' => route('experience.store'),
            'model' => $experience
        ]);

        return view('pages.agents.experiences.edit', [
            'form' => $form,
            'experience' => $experience
        ]);
    }


    public function store()
    {
        $form = $this->form(ExperienceForm::class);

        $agent = Agent::findOrFail($form->getRequest()->only('agent_id')['agent_id']);

        $form->validate(['date_debut' => 'required|date|after:'.$agent->date_naiss, 'date_fin' => 'required|date|after:date_debut|after:'.$agent->date_naiss]);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        Experience::create($form->getRequest()->all());
        return redirect()->route('experience.index')->with('success', 'Enregistrement effectué');

    }


    public function edit(Experience $experience)
    {
        $form = $this->form(ExperienceForm::class, [
            'method' => 'PUT',
            'url' => route('experience.update', $experience),
            'model' => $experience
        ]);

        return view('pages.agents.experiences.edit', [
            'form' => $form,
            'experience' => $experience
        ]);
    }


    public function update(Experience $experience)
    {
        $form = $this->form(ExperienceForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $experience->update($form->getRequest()->all());
        return redirect()->route('experience.index')->with('success', 'Mise à jour effectuée');

    }


    public function destroy(Experience $experience)
    {
        try {
            $experience->delete();
        }catch (\Exception $exception) {
            return redirect()->route('experience.index')->with('danger', 'Impossible de supprimer');

        }
        return redirect()->route('experience.index')->with('success', 'Suppression effectuée');

    }


    private function getData() {
        return DataTables::of(Experience::with('agent')->orderBy('created_at', 'desc')->get())
            ->addColumn('id', function ($experience){
                return $experience->id;
            })

            ->addColumn('agent', function ($experience){
                return $experience->agent->fullName;
            })
            ->addColumn('date_debut', function ($experience){
                return formaterDate($experience->date_debut);
            })
            ->addColumn('date_fin', function ($experience){
                return formaterDate($experience->date_fin);
            })
            ->addColumn('actions', function ($experience){
                $html = '<div class="btn-group">';
                $user = Auth::user();
                if($user->hasPermissionTo('EDITER_EXPERIENCE')) {
                    $html .= ' <a title="editer" href="' . route('experience.edit', $experience) . '" class="btn btn-outline-warning btn-sm mr-2"><i class="mdi mdi-account-edit mdi-18px"></i></a>';
                }

                if($user->hasPermissionTo('SUPPRIMER_EXPERIENCE')) {
                    $html .= ' <form action="' . route("experience.destroy", $experience) . '" id="del' . $experience->id . '" style="display: inline-block;" method="post">
                                ' . method_field('DELETE') . '
                                ' . csrf_field() . '
                                <button title="supprimer" class="btn btn-outline-danger btn-sm" type="button"
                                onclick="myHelpers.deleteConfirmation(\'del' . $experience->id . '\')">
                                    <i class="mdi mdi-18px mdi-trash-can-outline"></i>
                                </button>
                            </form>';
                }
                    $html .= ' </div>';
                return $html;
            })
            ->escapeColumns([])
            ->make(true);
    }
}
