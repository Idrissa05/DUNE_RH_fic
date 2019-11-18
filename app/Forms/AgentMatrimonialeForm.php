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
            ->add('agent_id', 'select', [
                'label' => 'Matricule Agent',
                'rules' => 'required|integer',
                'attr' => ['class'=>'form-control agent'],
                //'class' => Agent::class,
                'empty_value' => 'Sélectionner',
                /*'query_builder' => function (Agent $agent) {
                    return $agent->orderBy('matricule', 'asc')->pluck('matricule', 'id');
                }*/
            ])
            ->add('matrimoniale_id', 'entity', [
                'label' => 'Matrimoniale',
                'rules' => 'required|integer',
                'class' => Matrimoniale::class,
                'empty_value' => 'Sélectionner',
                'query_builder' => function (Matrimoniale $matrimoniale) {
                    return $matrimoniale->orderBy('name', 'asc')->pluck('name', 'id');
                }
            ])
            ->add('date', 'date', [
                'rules' => 'required|date', 'attr' => ['max' => null, 'min' => null]
            ]);
    }
}
