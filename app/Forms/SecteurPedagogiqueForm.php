<?php

namespace App\Forms;

use App\Models\Inspection;
use Kris\LaravelFormBuilder\Form;

class SecteurPedagogiqueForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Nom secteur',
            'rules' => 'required|string'
        ])
            ->add('inspection_id', 'entity', [
                'label' => 'Inspection',
                'rules' => 'required|integer',
                'class' => Inspection::class,
                'empty_value' => 'Sélectionner',
                'query_builder' => function (Inspection $inspection) {
                    return $inspection->pluck('name', 'id');
                }
            ]);
    }
}
