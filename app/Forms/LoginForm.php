<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class LoginForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'class' => 'row'
        ])
            ->add('password', 'password', [


            ]);
    }
}
