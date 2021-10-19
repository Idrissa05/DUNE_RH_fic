<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \Spatie\Permission\Models\Permission::create([
            'name' => 'ADMINISTRATION'
        ]);



        \Spatie\Permission\Models\Permission::create([
            'name' => 'CONSULTER_AGENT'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'EDITER_AGENT'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'SUPPRIMER_AGENT'
        ]);



        \Spatie\Permission\Models\Permission::create([
            'name' => 'ACTIONS_CONFIGURATION'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'CONSULTER_CONFIGURATION'
        ]);


        \Spatie\Permission\Models\Permission::create([
            'name' => 'CONSULTER_AFFECTATION'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'EDITER_AFFECTATION'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'SUPPRIMER_AFFECTATION'
        ]);


        \Spatie\Permission\Models\Permission::create([
            'name' => 'CONSULTER_AVANCEMENT'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'EDITER_AVANCEMENT'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'SUPPRIMER_AVANCEMENT'
        ]);


        \Spatie\Permission\Models\Permission::create([
            'name' => 'CONSULTER_CONGE'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'EDITER_CONGE'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'SUPPRIMER_CONGE'
        ]);


        \Spatie\Permission\Models\Permission::create([
            'name' => 'CONSULTER_CONJOINT'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'EDITER_CONJOINT'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'SUPPRIMER_CONJOINT'
        ]);


        \Spatie\Permission\Models\Permission::create([
            'name' => 'CONSULTER_DECE'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'EDITER_DECE'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'SUPPRIMER_DECE'
        ]);


        \Spatie\Permission\Models\Permission::create([
            'name' => 'CONSULTER_ENFANT'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'EDITER_ENFANT'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'SUPPRIMER_ENFANT'
        ]);


        \Spatie\Permission\Models\Permission::create([
            'name' => 'CONSULTER_EXPERIENCE'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'EDITER_EXPERIENCE'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'SUPPRIMER_EXPERIENCE'
        ]);


        \Spatie\Permission\Models\Permission::create([
            'name' => 'CONSULTER_FORMATION'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'EDITER_FORMATION'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'SUPPRIMER_FORMATION'
        ]);


        \Spatie\Permission\Models\Permission::create([
            'name' => 'CONSULTER_MALADIE'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'EDITER_MALADIE'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'SUPPRIMER_MALADIE'
        ]);


        \Spatie\Permission\Models\Permission::create([
            'name' => 'CONSULTER_MATRIMONIALE'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'EDITER_MATRIMONIALE'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'SUPPRIMER_MATRIMONIALE'
        ]);


        \Spatie\Permission\Models\Permission::create([
            'name' => 'EFFECTUER_MIGRATION'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'CONSULTER_MIGRATION'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'SUPPRIMER_MIGRATION'
        ]);


        \Spatie\Permission\Models\Permission::create([
            'name' => 'CONSULTER_NOTATION'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'EDITER_NOTATION'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'SUPPRIMER_NOTATION'
        ]);


        \Spatie\Permission\Models\Permission::create([
            'name' => 'CONSULTER_POSITION'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'EDITER_POSITION'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'SUPPRIMER_POSITION'
        ]);


        \Spatie\Permission\Models\Permission::create([
            'name' => 'CONSULTER_RECLASSEMENT'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'EDITER_RECLASSEMENT'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'SUPPRIMER_RECLASSEMENT'
        ]);


        \Spatie\Permission\Models\Permission::create([
            'name' => 'CONSULTER_RETRAITE'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'EDITER_RETRAITE'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'SUPPRIMER_RETRAITE'
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name' => 'IMPORTER_EXCEL'
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name' => 'GENERER_REQUETE'
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name' => 'ACCES_AGENT'
        ]);

        $role_agent = \Spatie\Permission\Models\Role::create([
            'name' => 'Enseignant'
        ]);
        $role_agent->givePermissionTo('ACCES_AGENT');

        $role = \Spatie\Permission\Models\Role::create([
            'name' => 'Administrateur'
        ]);
        $role->givePermissionTo('ADMINISTRATION');
        
        \App\User::create([
            'name'=>'admin',
            'password'=>Hash::make('admin'),
            'region_id'=>1,
            'ministere_id'=>1
        ]);
        $user = \App\User::first();
        $user->assignRole($role);

    }
}
