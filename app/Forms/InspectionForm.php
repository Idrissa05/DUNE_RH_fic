<?php

namespace App\Forms;

use App\Models\Departement;
use Kris\LaravelFormBuilder\Form;

class InspectionForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Nom inspection'
        ])
            ->add('departement_id', 'entity', [
                'label' => 'Département',
                'class' => Departement::class,
                'query_builder' => function (Departement $departement) {
                    return $departement->pluck('name', 'id');
                }
            ])
            ->add('submit', 'submit', ['label' => 'Enregistrer', 'attr' => ['class' => 'btn btn-primary']]);
    }
}
