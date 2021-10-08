<?php

namespace App\Forms;

use App\Models\Agent;
use Kris\LaravelFormBuilder\Form;

class NotationForm extends Form
{
    public function buildForm()
    {
        $this->add('date_debut', 'date', [
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
            ])->add('note_adminitratif', 'number', [
                'rules' => 'required',
                'attr' => [
                    'step' => 0.1,

                ]
            ])->add('note_pedagogique', 'number', [
                'rules' => 'required',
                'attr' => [
                    'step' => 0.1,

                ]
            ])->add('responsable', 'text', [
                'rules' => 'required'
            ])->add('observation', 'textarea', [
                'rules' => 'required',
                'label' => 'Appréciations'
            ])
            ->add('agent_id','select', [
                //'class' => Agent::class,
                'label' => 'Matricule Agent', 'rules' => 'required',
                'attr' => ['class'=>'form-control agent'],
                'empty_value' => 'Sélectionner',
                /*'query_builder' => function (Agent $agent) {
                    return $agent->pluck('matricule','id');
                }*/
            ]);
    }
}
