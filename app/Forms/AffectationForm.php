<?php

namespace App\Forms;

use App\Models\Agent;
use App\Models\Etablissement;
use Kris\LaravelFormBuilder\Form;

class AffectationForm extends Form
{
    public function buildForm()
    {
        $this->add('ref', 'text', [
            'rules' => 'required|'
        ])->add('date', 'date', [
            'rules' => 'required|date',
            'label' => 'Date début'
        ])
            ->add('date_prise_effet', 'date', [
                'rules' => 'required|date'
            ])->add('observation', 'text', [
                'rules' => 'required'
            ])
            ->add('agent_id','entity', [
                'class' => Agent::class,
                'label' => 'Matricule Agent', 'rules' => 'required',
                'query_builder' => function (Agent $agent) {
                    return $agent->pluck('matricule','id');
                }
            ])
            ->add('etablissement_id','entity', [
                'class' => Etablissement::class,
                'label' => 'Etablissement', 'rules' => 'required',
                'query_builder' => function (Etablissement $etablissement) {
                    return $etablissement->pluck('name','id');
                }
            ]);
    }
}
