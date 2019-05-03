<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormationsTable extends Migration {

	public function up()
	{
		Schema::create('formations', function(Blueprint $table) {
			$table->increments('id');
			$table->date('date_debut');
			$table->date('date_fin');
			$table->integer('agent_id')->unsigned();
			$table->integer('ecole_formation_id')->unsigned();
			$table->integer('diplome_id')->unsigned();
			$table->integer('niveau_etude_id')->unsigned();
			$table->integer('equivalence_diplome_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('formations');
	}
}