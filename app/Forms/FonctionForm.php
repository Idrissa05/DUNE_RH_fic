<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class FonctionForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Libellé'
        ]);
    }
}
