<?php

namespace App\Forms;

use App\Models\Agent;
use Kris\LaravelFormBuilder\Form;

class DeceForm extends Form
{
    public function buildForm()
    {
        $this->add('date', 'date', [
            'rules' => 'required|date',
            'label' => 'Date'
        ])
            ->add('ref_document', 'text', [
                'rules' => 'required'
            ])
            ->add('observation', 'text', [
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
