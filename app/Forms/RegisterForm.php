<?php

namespace App\Forms;

use App\Models\Ministere;
use App\Models\Region;
use Kris\LaravelFormBuilder\Form;
use Spatie\Permission\Models\Role;

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
            ])->add('verifier_login', 'text', [
                'value' => '1',
                'rules' => 'hiddin',
            ])
            ->add('password_confirmation', 'password', [
                'label' => 'Confirmation de mot de passe'
            ])
            ->add('region_id','entity', [
                'label'=>'Région',
                'rules' => 'required',
                'class' => Region::class,
                'empty_value' => 'Sélectionner',
                'query_builder' => function (Region $region) {
                    return $region->orderBy('name', 'asc')->pluck('name', 'id');
                }
            ])
            ->add('ministere_id','entity', [
                'label'=>'Directions',
                'rules' => 'required',
                'class' => Ministere::class,
                'empty_value' => 'Sélectionner',
                'query_builder' => function (Ministere $ministere) {
                    return $ministere->orderBy('id', 'asc')->pluck('name', 'id');
                }
            ])
            ->add('role_id','entity', [
                'label'=>'Rôle',
                'rules' => 'required',
                'class' => Role::class,
                'empty_value' => 'Sélectionner',
                'query_builder' => function (Role $role) {
                    return $role->orderBy('name', 'asc')->pluck('name', 'id');
                }
            ]);


    }
}
