<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class CadreForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Libellé',
            'rules' => 'required|string'
        ])
            ->add('abreviation', 'text', [
                'label' => 'Abréviation',
                'rules' => 'required|max:3'
            ]);
    }
}
