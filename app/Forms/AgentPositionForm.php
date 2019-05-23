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
                'label' => 'Agent',
                'rules' => 'required|integer',
                'class' => Agent::class,
                'query_builder' => function (Agent $agent) {
                    return $agent->pluck('matricule', 'id');
                }
            ])
            ->add('position_id', 'entity', [
                'label' => 'Position',
                'rules' => 'required|integer',
                'class' => Position::class,
                'query_builder' => function (Position $position) {
                    return $position->pluck('name', 'id');
                }
            ])

            ->add('ref_decision', 'text', [
                'rules' => 'required'

            ])
            ->add('date_decision', 'text', [
                'rules' => 'required|date'
            ])
            ->add('date_effet', 'text', [
                'rules' => 'required|date'
            ])
            ->add('observation', 'text', [
                'rules' => 'required'
            ]);

    }
}
