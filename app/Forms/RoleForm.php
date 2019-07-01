<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Spatie\Permission\Models\Permission;

class RoleForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Libellé',
            'rules' => 'required|string'
        ])
            ->add('permission_id', 'entity', [
                'label' => 'Permissions',
                'class' => Permission::class,
                'attr' => [
                    'id' => 'permission_id',
                ],
                'multiple' => true,
                'query_builder' => function (Permission $permission) {
                    return $permission->orderBy('name', 'asc')->pluck('name', 'id');
                }
            ]);
    }
}
