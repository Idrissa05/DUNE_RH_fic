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
        $this->add('date_debut', 'text', [
            'label' => 'Date début'
        ])
            ->add('date_fin', 'text')
            ->add('agent_id', 'entity', [
                'label' => 'Agent',
                'class' => Agent::class,
                'query_builder' => function (Agent $agent) {
                    return $agent->pluck('matricule', 'id');
                }
            ])

            ->add('ecole_formation_id', 'entity', [
                'label' => 'École de formation',
                'class' => EcoleFormation::class,
                'query_builder' => function (EcoleFormation $ecoleFormation) {
                    return $ecoleFormation->pluck('name', 'id');
                }
            ])

            ->add('diplome_id', 'entity', [
                'label' => 'Diplôme',
                'class' => Diplome::class,
                'query_builder' => function (Diplome $diplome) {
                    return $diplome->pluck('name', 'id');
                }
            ])


            ->add('niveau_etude_id', 'entity', [
                'label' => 'Niveu d\'étude',
                'class' => NiveauEtude::class,
                'query_builder' => function (NiveauEtude $niveauEtude) {
                    return $niveauEtude->pluck('name', 'id');
                }
            ])

            ->add('equivalence_diplome_id', 'entity', [
                'label' => 'Équivalence diplôme',
                'class' => EquivalenceDiplome::class,
                'query_builder' => function (EquivalenceDiplome $equivalenceDiplome) {
                    return $equivalenceDiplome->pluck('name', 'id');
                }
            ]);
    }
}
