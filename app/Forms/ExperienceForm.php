<?php

namespace App\Forms;

use App\Models\Agent;
use Kris\LaravelFormBuilder\Form;

class ExperienceForm extends Form
{
    public function buildForm()
    {
        $this->add('organisation', 'text', [
            'rules' => 'required|'
        ])->add('date_debut', 'date', [
            'rules' => 'required|date|before:date_fin',
            'label' => 'Date début',
            'attr' => [
                'max' => null,
                'min' => null
            ]
        ])
            ->add('date_fin', 'date', [
                'rules' => 'required|date|after:date_debut',
                'attr' => [
                    'max' => null,
                    'min' => null
                ]
            ])->add('fonction', 'text', [
                'rules' => 'required'
            ])->add('tache', 'text', [
                'rules' => 'required'
            ])->add('observation', 'text', [
                'rules' => 'required'
            ])
            ->add('agent_id','entity', [
                'class' => Agent::class,
                'label' => 'Matricule Agent', 'rules' => 'required',
                'empty_value' => 'Sélectionner',
                'query_builder' => function (Agent $agent) {
                    return $agent->pluck('matricule','id');
                }
            ]);
    }
}
