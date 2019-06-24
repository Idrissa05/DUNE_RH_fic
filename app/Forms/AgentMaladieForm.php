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
                'label' => 'Matricule Agent',
                'rules' => 'required|integer',
                'class' => Agent::class,
                'empty_value' => 'Sélectionner',
                'query_builder' => function (Agent $agent) {
                    return $agent->orderBy('matricule', 'asc')->pluck('matricule', 'id');
                }
            ])
            ->add('maladie_id', 'entity', [
                'label' => 'Maladie',
                'rules' => 'required|integer',
                'class' => Maladie::class,
                'empty_value' => 'Sélectionner',
                'query_builder' => function (Maladie $maladie) {
                    return $maladie->orderBy('name', 'asc')->pluck('name', 'id');
                }
            ])
            ->add('observation', 'text', [
                'label' => 'Observation',
                'rules' => 'required'

            ])
                ->add('date_observation', 'date', [
                    'rules' => 'required|date', 'attr' => ['max' => null, 'min' => null]
                ]);
    }
}
