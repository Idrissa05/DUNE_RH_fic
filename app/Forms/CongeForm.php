<?php

namespace App\Forms;

use App\Models\Agent;
use Kris\LaravelFormBuilder\Form;

class CongeForm extends Form
{
    public function buildForm()
    {
        $this->add('ref_decision', 'text')
            ->add('date_debut', 'text')
            ->add('date_fin', 'text')
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
