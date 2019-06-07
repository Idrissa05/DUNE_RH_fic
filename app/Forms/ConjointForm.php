<?php

namespace App\Forms;

use App\Models\Agent;
use Kris\LaravelFormBuilder\Form;

class ConjointForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('matricule','text',[
                'label'=>'N° Matricule', 'rules' => 'required|string'
            ])
            ->add('nom','text', [
                'label'=>'Nom', 'rules' => 'required|string'
            ])
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
            ->add('nationnalite','text', [
                'label'=>'Nationnalité', 'rules' => 'required|string'
            ])
            ->add('tel','text', [
                'label'=>'Téléphone', 'rules' => 'required|string'
            ])
            ->add('employeur','text', [
                 'rules' => 'required|string'
            ])
            ->add('profession','text', [
                'rules' => 'required|string'
            ])
            ->add('ref_acte_mariage','text', [
                'label' => 'Réference acte de mariage',
                'rules' => 'required|string'
            ])
            ->add('agent_id','entity', [
                'class' => Agent::class,
                'label' => 'Matricule Agent', 'rules' => 'required',
                'query_builder' => function (Agent $agent) {
                    return $agent->pluck('matricule','id');
                }
            ]);
    }
}
