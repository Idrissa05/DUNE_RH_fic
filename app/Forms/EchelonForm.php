<?php

namespace App\Forms;

use App\Models\Classe;
use Kris\LaravelFormBuilder\Form;

class EchelonForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Nom échelon',
            'rules' => 'required|string'
        ])
            ->add('description', 'text', [
                'rules' => 'required|string'
            ])
            ->add('classe_id', 'entity', [
                'label' => 'Classe',
                'rules' => 'required|integer',
                'class' => Classe::class,
                'query_builder' => function (Classe $classe) {
                    return $classe->pluck('name', 'id');
                }
            ]);
    }
}
