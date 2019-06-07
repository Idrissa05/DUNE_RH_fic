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
            'rules' => 'required|date|before:date_fin'

        ])
            ->add('date_fin', 'date', [
                'rules' => 'required|date|after:date_debut'
            ])
            ->add('agent_id', 'entity', [
                'label' => 'Matricule Agent',
                'rules' => 'required|integer',
                'class' => Agent::class,
                'query_builder' => function (Agent $agent) {
                    return $agent->pluck('matricule', 'id');
                }
            ])

            ->add('ecole_formation_id', 'entity', [
                'label' => 'École de formation',
                'rules' => 'required|integer',
                'class' => EcoleFormation::class,
                'query_builder' => function (EcoleFormation $ecoleFormation) {
                    return $ecoleFormation->pluck('name', 'id');
                }
            ])

            ->add('diplome_id', 'entity', [
                'label' => 'Diplôme',
                'rules' => 'required|integer',
                'class' => Diplome::class,
                'query_builder' => function (Diplome $diplome) {
                    return $diplome->pluck('name', 'id');
                }
            ])


            ->add('niveau_etude_id', 'entity', [
                'label' => 'Niveu d\'étude',
                'rules' => 'required|integer',
                'class' => NiveauEtude::class,
                'query_builder' => function (NiveauEtude $niveauEtude) {
                    return $niveauEtude->pluck('name', 'id');
                }
            ])

            ->add('equivalence_diplome_id', 'entity', [
                'label' => 'Équivalence diplôme',
                'rules' => 'required|integer',
                'class' => EquivalenceDiplome::class,
                'query_builder' => function (EquivalenceDiplome $equivalenceDiplome) {
                    return $equivalenceDiplome->pluck('name', 'id');
                }
            ]);
    }
}
