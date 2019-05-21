<?php

namespace App\Forms;

use App\Models\Agent;
use Kris\LaravelFormBuilder\Form;

class RetraiteForm extends Form
{
    public function buildForm()
    {
        $this->add('date', 'text', [
            'rules' => 'required|date',
            'label' => 'Date'
        ])
            ->add('ref_decision', 'text', [
                'rules' => 'required'
            ])
            ->add('date_decision', 'text', [
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
