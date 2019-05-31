<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class RegisterForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'rules' => 'required',
            'label' => "Nom d'utilisateur"
        ])
            ->add('password', 'password', [
                'label' => 'Mot de passe'
            ])
            ->add('password_confirmation', 'password', [
                'label' => 'Confirmation de mot de passe'
            ])
            ->add('role','select', [
                'label'=>'Rôle', 'rules' => 'required',
                'choices' => ['Administrateur' => 'Administrateur', 'Membre' => 'Membre']
            ]);


    }
}
