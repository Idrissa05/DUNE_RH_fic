<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class EquivalenceDiplomeForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Libellé',
            'rules' => 'required|string'
        ]);
    }
}
