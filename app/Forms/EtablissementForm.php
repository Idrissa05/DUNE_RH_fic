<?php

namespace App\Forms;

use App\Models\Inspection;
use App\Models\Localite;
use App\Models\SecteurPedagogique;
use App\Models\TypeEtablissement;
use Kris\LaravelFormBuilder\Form;

class EtablissementForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Nom établissement',
            'rules' => 'required|string'

        ])
            ->add('secteur_pedagogique_id', 'entity', [
                'label' => 'Secteur pédagogique',
                'rules' => 'required|integer',
                'class' => SecteurPedagogique::class,
                'query_builder' => function (SecteurPedagogique $secteurPedagogique) {
                    return $secteurPedagogique->pluck('name', 'id');
                }
            ])
            ->add('type_etablissement_id', 'entity', [
                'label' => 'Type établissement',
                'rules' => 'required|integer',
                'class' => TypeEtablissement::class,
                'query_builder' => function (TypeEtablissement $typeEtablissement) {
                    return $typeEtablissement->pluck('name', 'id');
                }
            ]);
    }
}
