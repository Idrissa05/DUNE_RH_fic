<?php

namespace App\Forms;

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
            ->add('departement_id', 'entity', [
                'label' => 'Département',
                'rules' => 'required|integer',
                'class' => Departement::class,
                'query_builder' => function (Departement $departement) {
                    return $departement->pluck('name', 'id');
                }
            ]);
    }
}
