<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ConfigForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Nom'
        ])
            ->add('theme', 'select', [
                'label' => 'Thème',
                'choices' => $this->getChoices()
            ])
            ->add('age_retraite', 'text');
    }


    private function getChoices() {
        return [
            'default.css' => 'Par défaut',
            'purple.css' => 'Purple',
            'purple-dark.css' => 'Purple Dark',
            'red.css' => 'Red',
            'red-dark.css' => 'Red Dark',

        ];
    }
}
