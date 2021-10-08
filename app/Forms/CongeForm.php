<?php

namespace App\Forms;

use App\Models\Agent;
use Kris\LaravelFormBuilder\Form;

class CongeForm extends Form
{
    public function buildForm()
    {
        $this->add('ref_decision', 'text')
            ->add('date_debut', 'date', [
                'rules' => 'required|date|before:date_fin',
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
            ])
            ->add('observation', 'textarea')
            ->add('agent_id', 'select', [
                'label' => 'Matricule Agent',
                'rules' => 'required|integer',
                'attr' => ['class'=>'form-control agent'],
                //'class' => Agent::class,
                'empty_value' => 'Sélectionner',
                /*'query_builder' => function (Agent $agent) {
                    return $agent->orderBy('matricule', 'asc')->pluck('matricule', 'id');
                }*/
            ]);
    }
}
