<?php

namespace App\Http\Controllers;

use App\Forms\RoleForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    use FormBuilderTrait;


    public function index() {
        $roles = Role::all();

        return view('system.acl.roles.index', [
            'roles' => $roles
        ]);
    }


    public function create() {
        $form = $this->form(RoleForm::class, [
            'method' => 'POST',
            'url' => route('role.store')
        ]);
        $role = new Role();
        return view('system.acl.roles.edit', [
            'role' => $role,
            'form' => $form
        ]);
    }

    public function store() {
        $form = $this->form(RoleForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
        }

        $role = Role::create(['name' => $form->getRequest()->name]);
        $role->syncPermissions($form->getRequest()->permission_id);

        return redirect()->route('role.index')->with('success', 'Opération effectuée !');
    }


    public function edit(Role $role) {
        $role->permission_id = $role->permissions()->pluck('id')->toArray();
        $form = $this->form(RoleForm::class, [
            'method' => 'PUT',
            'url' => route('role.update', $role),
            'model' => $role
        ]);
        return view('system.acl.roles.edit', [
            'role' => $role,
            'form' => $form
        ]);
    }


    public function update(Role $role) {

        $form = $this->form(RoleForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput()->with('danger', 'Une erreur est survenue');
        }

        $role->update(['name' => $form->getRequest()->name]);
        $role->syncPermissions($form->getRequest()->permission_id);

        return redirect()->route('role.index')->with('success', 'Opération effectuée !');
    }


    public function destroy() {

    }
}
