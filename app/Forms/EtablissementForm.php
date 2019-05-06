<?php

namespace App\Forms;

use App\Models\Inspection;
use App\Models\Localite;
use App\Models\TypeEtablissement;
use Kris\LaravelFormBuilder\Form;

class EtablissementForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Nom établissement'
        ])
            ->add('inspection_id', 'entity', [
                'label' => 'Inspection',
                'class' => Inspection::class,
                'query_builder' => function (Inspection $inspection) {
                    return $inspection->pluck('name', 'id');
                }
            ])
            ->add('localite_id', 'entity', [
                'label' => 'Localité',
                'class' => Localite::class,
                'query_builder' => function (Localite $localite) {
                    return $localite->pluck('name', 'id');
                }
            ])
            ->add('type_etablissement_id', 'entity', [
                'label' => 'Type établissement',
                'class' => TypeEtablissement::class,
                'query_builder' => function (TypeEtablissement $typeEtablissement) {
                    return $typeEtablissement->pluck('name', 'id');
                }
            ])
            ->add('submit', 'submit', ['label' => 'Enregistrer', 'attr' => ['class' => 'btn btn-primary']]);
    }
}
