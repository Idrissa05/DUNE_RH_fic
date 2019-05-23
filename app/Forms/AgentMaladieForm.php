<?php

namespace App\Forms;

use App\Models\Agent;
use App\Models\Maladie;
use Kris\LaravelFormBuilder\Form;

class AgentMaladieForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('agent_id', 'entity', [
                'label' => 'Agent',
                'rules' => 'required|integer',
                'class' => Agent::class,
                'query_builder' => function (Agent $agent) {
                    return $agent->pluck('matricule', 'id');
                }
            ])
            ->add('maladie_id', 'entity', [
                'label' => 'Maladie',
                'rules' => 'required|integer',
                'class' => Maladie::class,
                'query_builder' => function (Maladie $maladie) {
                    return $maladie->pluck('name', 'id');
                }
            ])
            ->add('observation', 'text', [
                'label' => 'Observation',
                'rules' => 'required'

            ])
                ->add('date_observation', 'text', [
                    'rules' => 'required|date'
                ]);
    }
}
