<?php

namespace App\Forms;

use App\Models\Agent;
use App\Models\Diplome;
use App\Models\EcoleFormation;
use App\Models\EquivalenceDiplome;
use App\Models\NiveauEtude;
use Kris\LaravelFormBuilder\Form;

class FormationForm extends Form
{
    public function buildForm()
    {
        $this->add('date_debut', 'date', [
            'label' => 'Date début',
            'rules' => 'required|date|before:date_fin',
            'attr' => [
                'max' => null,
                'min' => null
            ]

        ])
            ->add('date_fin', 'date', [
                'rules' => 'required|date|after:date_debut',
                'attr' => [
                    'max' => null,
                    'min' => null
                ]
            ])
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

            ->add('ecole_formation_id', 'entity', [
                'label' => 'École de formation',
                'rules' => 'required|integer',
                'class' => EcoleFormation::class,
                'empty_value' => 'Sélectionner',
                'query_builder' => function (EcoleFormation $ecoleFormation) {
                    return $ecoleFormation->orderBy('name', 'asc')->pluck('name', 'id');
                }
            ])

            ->add('diplome_id', 'entity', [
                'label' => 'Diplôme',
                'rules' => 'required|integer',
                'class' => Diplome::class,
                'empty_value' => 'Sélectionner',
                'query_builder' => function (Diplome $diplome) {
                    return $diplome->orderBy('name', 'asc')->pluck('name', 'id');
                }
            ])


            ->add('niveau_etude_id', 'entity', [
                'label' => 'Niveu d\'étude',
                'rules' => 'integer','attr' => ['disabled' => 'disabled'],
                'class' => NiveauEtude::class,
                'empty_value' => 'Sélectionner',
                'query_builder' => function (NiveauEtude $niveauEtude) {
                    return $niveauEtude->orderBy('name', 'asc')->pluck('name', 'id');
                }
            ])

            ->add('equivalence_diplome_id', 'entity', [
                'label' => 'Équivalence diplôme',
                'rules' => 'integer',
                'class' => EquivalenceDiplome::class,'attr' => ['disabled' => 'disabled'],
                'empty_value' => 'Sélectionner',
                'query_builder' => function (EquivalenceDiplome $equivalenceDiplome) {
                    return $equivalenceDiplome->orderBy('name', 'asc')->pluck('name', 'id');
                }
            ]);
    }
}
