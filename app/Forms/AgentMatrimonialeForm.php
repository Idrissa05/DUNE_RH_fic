<?php

namespace App\Forms;

use App\Models\Agent;
use App\Models\Matrimoniale;
use Kris\LaravelFormBuilder\Form;

class AgentMatrimonialeForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('agent_id', 'entity', [
                'label' => 'Matricule Agent',
                'rules' => 'required|integer',
                'class' => Agent::class,
                'query_builder' => function (Agent $agent) {
                    return $agent->pluck('matricule', 'id');
                }
            ])
            ->add('matrimoniale_id', 'entity', [
                'label' => 'Matrimoniale',
                'rules' => 'required|integer',
                'class' => Matrimoniale::class,
                'query_builder' => function (Matrimoniale $matrimoniale) {
                    return $matrimoniale->pluck('name', 'id');
                }
            ])
            ->add('date', 'date', [
                'rules' => 'required|date'
            ]);
    }
}
