<?php

namespace App\Forms;

use App\Models\Category;
use Kris\LaravelFormBuilder\Form;

class ClasseForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Nom classe',
            'rules' => 'required|string'
        ])
            ->add('description', 'text', [
                'rules' => 'required|string'

            ]);
    }
}
