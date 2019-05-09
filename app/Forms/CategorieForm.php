<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class CategorieForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Nom catégorie',
            'rules' => 'required|string'
        ]);
    }
}
