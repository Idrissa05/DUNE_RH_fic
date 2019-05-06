<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class EcoleFormationForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Nom de l\'école'
        ]);
    }
}
