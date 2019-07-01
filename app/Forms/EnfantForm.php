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
                'label'=>'Date de Naissance', 'rules' => 'required|date', 'attr' => ['max' => null, 'min' => null]
            ])
            ->add('lieu_naiss','text', [
                'label'=>'Lieu de Naissance'
            ])
            ->add('ref_acte_naiss','text', [
                'label'=>'Référence Acte Naissance'
            ])
            ->add('sexe','select', [
                'label'=>'Sexe', 'rules' => 'required',
                'choices' => ['F' => 'Féminin', 'M' => 'Masculin'],
                'empty_value' => 'Sélectionner'
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
