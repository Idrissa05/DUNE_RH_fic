<?php

namespace App\Forms;

use App\Models\Agent;
use Kris\LaravelFormBuilder\Form;

class EnfantForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('prenom','text', [
                'label'=>'Prénom', 'rules' => 'required|string'
            ])
            ->add('date_naiss','date', [
                'label'=>'Date de Naissance', 'rules' => 'required|date',
            ])
            ->add('lieu_naiss','text', [
                'label'=>'Lieu de Naissance'
            ])
            ->add('sexe','select', [
                'label'=>'Sexe', 'rules' => 'required',
                'choices' => ['F' => 'Féminin', 'M' => 'Masculin'],
                'empty_value' => 'Sélectionner'
            ])
            ->add('agent_id','entity', [
                'class' => Agent::class,
                'label' => 'Agent', 'rules' => 'required',
                'query_builder' => function (Agent $agent) {
                    return $agent->pluck('matricule','id');
                }
            ]);
    }
}