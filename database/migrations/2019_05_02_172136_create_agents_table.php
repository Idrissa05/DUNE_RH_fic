<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAgentsTable extends Migration {

	public function up()
	{
		Schema::create('agents', function(Blueprint $table) {
			$table->increments('id');
            $table->string('matricule', 15)->unique();
			$table->string('nom', 40);
			$table->string('prenom', 50);
			$table->date('date_naiss');
			$table->string('lieu_naiss', 30);
            $table->string('ref_acte_naiss', 30);
            $table->date('date_etablissement_acte_naiss');
            $table->string('lieu_etablissement_acte_naiss', 30);
			$table->char('sexe', 1);
			$table->string('nationnalite', 20);
            $table->integer('cadre_id')->unsigned();
            $table->integer('corp_id')->unsigned();
            $table->string('type', 15);
            $table->integer('fonction_id')->unsigned()->nullable();
            $table->date('date_prise_service')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('agents');
	}
}
