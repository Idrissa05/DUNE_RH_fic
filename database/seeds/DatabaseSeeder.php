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
            'name' => 'AJOUTER_CONFIGURATION'
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name' => 'MODIFIER_CONFIGURATION'
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name' => 'SUPPRIMER_CONFIGURATION'
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name' => 'CONSULTER_CONFIGURATION'
        ]);
    }
}
