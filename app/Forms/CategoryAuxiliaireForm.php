<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class CategoryAuxiliaireForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Nom catégorie',
            'rules' => 'required|string'
        ]);
    }
}
