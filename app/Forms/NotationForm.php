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
            'label' => 'Date début'
        ])
            ->add('date_fin', 'date', [
                'rules' => 'required|date|after:date_debut'
            ])->add('note', 'number', [
                'rules' => 'required'
            ])->add('responsable', 'text', [
                'rules' => 'required'
            ])->add('observation', 'text', [
                'rules' => 'required'
            ])
            ->add('agent_id','entity', [
                'class' => Agent::class,
                'label' => 'Matricule Agent', 'rules' => 'required',
                'query_builder' => function (Agent $agent) {
                    return $agent->pluck('matricule','id');
                }
            ]);
    }
}
