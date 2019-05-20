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
            'label' => 'Nom établissement',
            'rules' => 'required|string'

        ])
            ->add('inspection_id', 'entity', [
                'label' => 'Inspection',
                'rules' => 'required|integer',
                'class' => Inspection::class,
                'query_builder' => function (Inspection $inspection) {
                    return $inspection->pluck('name', 'id');
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
