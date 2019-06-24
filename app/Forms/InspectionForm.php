<?php

namespace App\Forms;

use App\Models\Commune;
use App\Models\Departement;
use Kris\LaravelFormBuilder\Form;

class InspectionForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Nom inspection',
            'rules' => 'required|string'
        ])
            ->add('commune_id', 'entity', [
                'label' => 'Commune',
                'rules' => 'required|integer',
                'class' => Commune::class,
                'empty_value' => 'Sélectionner',
                'query_builder' => function (Commune $commune) {
                    return $commune->orderBy('name', 'asc')->pluck('name', 'id');
                }
            ]);
    }
}
