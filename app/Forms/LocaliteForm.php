<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class LocaliteForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Nom localité',
            'rules' => 'required|string'
        ]);
    }
}
