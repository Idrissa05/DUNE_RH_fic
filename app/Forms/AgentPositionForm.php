<?php

namespace App\Forms;

use App\Models\Agent;
use App\Models\Position;
use Kris\LaravelFormBuilder\Form;

class AgentPositionForm extends Form
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
            ->add('position_id', 'entity', [
                'label' => 'Position',
                'rules' => 'required|integer',
                'class' => Position::class,
                'empty_value' => 'Sélectionner',
                'query_builder' => function (Position $position) {
                    return $position->orderBy('name', 'asc')->pluck('name', 'id');
                }
            ])

            ->add('ref_decision', 'text', [
                'rules' => 'required'

            ])
            ->add('date_decision', 'date', [
                'rules' => 'required|date', 'attr' => ['max' => null, 'min' => null]
            ])
            ->add('date_effet', 'date', [
                'rules' => 'required|date', 'attr' => ['max' => null, 'min' => null]
            ])
            ->add('date_fin', 'date', [
                'rules' => 'required|date', 'attr' => ['max' => null, 'min' => null]
            ])
            ->add('observation', 'text', [
                'rules' => 'required'
            ]);

    }
}
