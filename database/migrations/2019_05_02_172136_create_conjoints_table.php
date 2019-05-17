<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConjointsTable extends Migration {

	public function up()
	{
		Schema::create('conjoints', function(Blueprint $table) {
			$table->increments('id');
            $table->string('matricule', 20)->nullable();
			$table->string('nom', 40);
			$table->string('prenom', 50);
			$table->date('date_naiss');
			$table->string('lieu_naiss', 30);
			$table->char('sexe', 1);
			$table->string('nationnalite', 20);
			$table->string('tel', 20);
			$table->string('employeur', 40)->nullable();
			$table->string('profession', 40);
            $table->string('ref_acte_mariage', 20);
			$table->integer('agent_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('conjoints');
	}
}
