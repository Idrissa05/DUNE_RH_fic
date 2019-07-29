<?php

namespace App\Http\Controllers;

use App\Forms\ExperienceForm;
use App\Forms\ReclassementForm;
use App\Models\Agent;
use App\Models\Experience;
use App\Models\Reclassement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Yajra\DataTables\Facades\DataTables;

class ReclassementController extends Controller {
    use FormBuilderTrait;

    public function __construct()
    {
        $this->middleware('permission:CONSULTER_RECLASSEMENT');
        $this->middleware('permission:EDITER_RECLASSEMENT')->only('store', 'update');
        $this->middleware('permission:SUPPRIMER_RECLASSEMENT')->only('destroy');
    }

    public function index(Request $request)
    {
        if($request->ajax()) {
            return $this->getData();
        }
        return view('pages.agents.reclassements.index');

    }


    public function create()
    {
        $reclassement = new Reclassement();

        $form = $this->form(ReclassementForm::class, [
            'method' => 'POST',
            'url' => route('reclassement.store'),
            'model' => $reclassement
        ]);

        return view('pages.agents.reclassements.edit', [
            'form' => $form,
            'reclassement' => $reclassement
        ]);
    }


    public function store()
    {
        $form = $this->form(ReclassementForm::class);

        $agent = Agent::findOrFail($form->getRequest()->only('agent_id')['agent_id']);

        $form->validate(['date_reclassement' => 'date|required|after:'.$agent->date_naiss, 'agent_id' => 'required|integer'],[
            'date_reclassement.after' => 'Le champ Date reclassement doit être une date supérieur à la date de naissance de l\'agent.'
        ]);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        Reclassement::create($form->getRequest()->all());
        return redirect()->route('reclassement.index')->with('success', 'Enregistrement effectué');

    }


    public function edit(Reclassement $reclassement)
    {
        $form = $this->form(ReclassementForm::class, [
            'method' => 'PUT',
            'url' => route('reclassement.update', $reclassement),
            'model' => $reclassement
        ]);

        return view('pages.agents.reclassements.edit', [
            'form' => $form,
            'reclassement' => $reclassement
        ]);
    }


    public function update(Reclassement $reclassement)
    {
        $form = $this->form(ReclassementForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        if($reclassement->agent->grades->last()->id != $reclassement->id){
            return redirect()->route('reclassement.index')->with('danger', 'Impossible de modifier ce reclassement');
        }else {
            $reclassement->update($form->getRequest()->all());
        }
        return redirect()->route('reclassement.index')->with('success', 'Mise à jour effectuée');

    }


    public function destroy(Reclassement $reclassement)
    {
        if($reclassement->agent->grades->last()->id != $reclassement->id){
            return redirect()->route('reclassement.index')->with('danger', 'Impossible de supprimer ce reclassement');
        }else {
            try {
                $reclassement->delete();
            } catch (\Exception $exception) {
                return redirect()->route('reclassement.index')->with('danger', 'Impossible de supprimer');

            }
            return redirect()->route('reclassement.index')->with('success', 'Suppression effectuée');
        }

    }


    private function getData() {
        return DataTables::of(Reclassement::with('agent', 'classe', 'echelon', 'category')->orderBy('created_at', 'desc')->get())
            ->addColumn('id', function ($reclassement){
                return $reclassement->id;
            })

            ->addColumn('agent', function ($reclassement){
                return $reclassement->agent->fullName;
            })
            ->addColumn('category', function ($reclassement){
                return $reclassement->category->name;
            })
            ->addColumn('classe', function ($reclassement){
                return $reclassement->classe->name;
            })
            ->addColumn('echelon', function ($reclassement){
                return $reclassement->echelon->name;
            })
            ->addColumn('actions', function ($reclassement){
                $html = '<div class="btn-group">';
                $user = Auth::user();
                if($user->hasPermissionTo('EDITER_REClASSEMENT')) {
                    $html .= ' <a title="editer" href="' . route('reclassement.edit', $reclassement) . '" class="btn btn-outline-warning btn-sm mr-2"><i class="mdi mdi-account-edit mdi-18px"></i></a>';
                }

                if($user->hasPermissionTo('SUPPRIMER_RECLASSEMENT')) {
                    $html .= ' <form action="' . route("reclassement.destroy", $reclassement) . '" id="del' . $reclassement->id . '" style="display: inline-block;" method="post">
                                ' . method_field('DELETE') . '
                                ' . csrf_field() . '
                                <button title="supprimer" class="btn btn-outline-danger btn-sm" type="button"
                                onclick="myHelpers.deleteConfirmation(\'del' . $reclassement->id . '\')">
                                    <i class="mdi mdi-18px mdi-trash-can-outline"></i>
                                </button>
                            </form>';
                }
                    $html .= '</div>';
                return $html;
            })
            ->escapeColumns([])
            ->make(true);
    }
}
