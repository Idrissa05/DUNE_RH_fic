<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class MatrimonialeForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Libellé'
        ]);
    }
}
