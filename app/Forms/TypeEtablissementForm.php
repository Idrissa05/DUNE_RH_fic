<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class TypeEtablissementForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Nom type établissement'
        ]);
    }
}
