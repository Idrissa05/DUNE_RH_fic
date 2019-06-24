<?php

namespace App\Forms;

use App\Models\Departement;
use Kris\LaravelFormBuilder\Form;

class CommuneForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Nom commune',
            'rules' => 'required|string'
        ])
            ->add('departement_id', 'entity', [
                'label' => 'Département',
                'rules' => 'required|integer',
                'class' => Departement::class,
                'empty_value' => 'Sélectionner',
                'query_builder' => function (Departement $departement) {
                    return $departement->orderBy('name', 'asc')->pluck('name', 'id');
                }
            ]);
    }
}
