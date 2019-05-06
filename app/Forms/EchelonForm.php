<?php

namespace App\Forms;

use App\Models\Classe;
use Kris\LaravelFormBuilder\Form;

class EchelonForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Nom échelon'
        ])
            ->add('description', 'text')
            ->add('classe_id', 'entity', [
                'label' => 'Classe',
                'class' => Classe::class,
                'query_builder' => function (Classe $classe) {
                    return $classe->pluck('name', 'id');
                }
            ])
            ->add('submit', 'submit', ['label' => 'Enregistrer', 'attr' => ['class' => 'btn btn-primary']]);
    }
}
