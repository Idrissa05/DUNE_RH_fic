<?php

namespace App\Forms;

use App\Models\Agent;
use App\Models\Etablissement;
use Kris\LaravelFormBuilder\Form;

class AffectationForm extends Form
{
    public function buildForm()
    {
        $this->add('ref', 'text', [
            'rules' => 'required|'
        ])->add('date', 'date', [
            'rules' => 'required|date', 'attr' => ['max' => null, 'min' => null],
            'label' => 'Date Affectation'
        ])
            ->add('date_prise_effet', 'date', [
                'rules' => 'required|date','attr' => ['max' => null, 'min' => null]
            ])->add('observation', 'text', [
                'rules' => 'required'
            ])
            ->add('agent_id','select', [
                //'class' => Agent::class,
                'label' => 'Matricule Agent', 'rules' => 'required',
                'attr' => ['class'=>'form-control agent'],
                'empty_value' => 'Sélectionner',
                /*'query_builder' => function (Agent $agent) {
                    return $agent->orderBy('matricule', 'asc'->pluck('matricule','id');
                }*/
            ])
            ->add('etablissement_id','select', [
                //'class' => Etablissement::class,
                'label' => 'Etablissement', 'rules' => 'required', 'attr' => ['class'=>'form-control etablissement'],
                'empty_value' => 'Sélectionner',
                /*'query_builder' => function (Etablissement $etablissement) {
                    return $etablissement->orderBy('name', 'asc')->pluck('name','id');
                }*/
            ]);
    }
}
