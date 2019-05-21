<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class CadreForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Libellé'
        ])
            ->add('abreviation', 'text', [
                'label' => 'Abréviation',
                'rules' => 'required|max:3'
            ]);
    }
}
