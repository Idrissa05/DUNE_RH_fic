<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Models\TypeEnseignement;

class AgentTypeEnseignementForm extends Form
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
            ->add('type_enseignement_id', 'entity', [
                'label' => 'Type Enseignement',
                'rules' => 'required|integer',
                'class' => TypeEnseignement::class,
                'empty_value' => 'Sélectionner',
                'query_builder' => function (TypeEnseignement $type_enseignement) {
                    return $type_enseignement->orderBy('name', 'asc')->pluck('name', 'id');
                }
            ])
            ->add('date', 'date', [
                'rules' => 'required|date', 'attr' => ['max' => null, 'min' => null]
            ]);
    }
}