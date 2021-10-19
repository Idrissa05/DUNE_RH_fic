<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAgentsTable extends Migration {

	public function up()
	{
		Schema::create('agents', function(Blueprint $table) {
			$table->increments('id');
            $table->string('matricule', 15)->unique();
			$table->string('nom', 100);
			$table->string('prenom', 100)->nullable();
			$table->string('telephone', 13)->nullable();
			$table->date('date_naiss');
			$table->string('lieu_naiss', 30);
            $table->string('ref_acte_naiss', 30);
            $table->date('date_etablissement_acte_naiss');
            $table->string('lieu_etablissement_acte_naiss', 30);
			$table->char('sexe', 1);
			$table->string('nationnalite', 20);
            $table->string('type', 15);
            $table->date('date_prise_service')->nullable();
            $table->integer('created_by_region_id')->unsigned();
            $table->integer('created_by_ministere_id')->unsigned();
			$table->timestamps(2);
			$table->softDeletes('deleted_at',2);
		});
	}

	public function down()
	{
		Schema::drop('agents');
	}
}
