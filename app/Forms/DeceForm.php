<?php

namespace App\Forms;

use App\Models\Agent;
use Kris\LaravelFormBuilder\Form;

class DeceForm extends Form
{
    public function buildForm()
    {
        $this->add('date', 'date', [
            'rules' => 'required|date', 'attr' => ['max' => null, 'min' => null],
            'label' => 'Date'
        ])
            ->add('ref_document', 'text', [
                'rules' => 'required'
            ])
            ->add('observation', 'text', [
                'rules' => 'required',
                'label' => 'Cause du decès'
            ])
            ->add('agent_id','entity', [
                'class' => Agent::class,
                'label' => 'Matricule Agent', 'rules' => 'required',
                'empty_value' => 'Sélectionner',
                'query_builder' => function (Agent $agent) {
                    return $agent->orderBy('matricule', 'asc')->pluck('matricule','id');
                }
            ]);
    }
}
