<?php

namespace App\Forms;

use App\Models\Agent;
use Kris\LaravelFormBuilder\Form;

class NotationForm extends Form
{
    public function buildForm()
    {
        $this->add('date_debut', 'text', [
            'rules' => 'required|date|before:date_fin',
            'label' => 'Date début'
        ])
            ->add('date_fin', 'text', [
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
                'label' => 'Agent', 'rules' => 'required',
                'query_builder' => function (Agent $agent) {
                    return $agent->pluck('matricule','id');
                }
            ]);
    }
}
