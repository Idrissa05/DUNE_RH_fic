<?php

namespace App\Forms;

use App\Models\Agent;
use Kris\LaravelFormBuilder\Form;

class CongeForm extends Form
{
    public function buildForm()
    {
        $this->add('ref_decision', 'text')
            ->add('date_debut', 'text', [
                'rules' => 'required|date|before:date_fin'
            ])
            ->add('date_fin', 'text', [
                'rules' => 'required|date|after:date_debut'
            ])
            ->add('observation', 'text')
            ->add('agent_id', 'entity', [
                'label' => 'Agent',
                'rules' => 'required|integer',
                'class' => Agent::class,
                'query_builder' => function (Agent $agent) {
                    return $agent->pluck('matricule', 'id');
                }
            ]);
    }
}
