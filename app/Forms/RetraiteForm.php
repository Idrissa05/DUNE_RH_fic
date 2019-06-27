<?php

namespace App\Forms;

use App\Models\Agent;
use Kris\LaravelFormBuilder\Form;

class RetraiteForm extends Form
{
    public function buildForm()
    {
        $this->add('date', 'date', [
            'rules' => 'required|date', 'attr' => ['max' => null, 'min' => null],
            'label' => 'Date'
        ])
            ->add('ref_decision', 'text', [
                'rules' => 'required'
            ])
            ->add('date_decision', 'date', [
                'label' => 'Date décision', 'rules' => 'required|date', 'attr' => ['max' => null, 'min' => null]
            ])
            ->add('lieu', 'text', [
                'label' => 'Lieu de jouissance'
            ])
            ->add('contact', 'text', [
            ])
            ->add('observation', 'text', [
                'rules' => 'required'
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
