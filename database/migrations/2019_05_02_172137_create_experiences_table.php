<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExperiencesTable extends Migration {

	public function up()
	{
		Schema::create('experiences', function(Blueprint $table) {
			$table->increments('id');
			$table->string('organisation', 40);
			$table->date('date_debut');
			$table->date('date_fin');
			$table->string('fonction', 40);
			$table->string('tache');
			$table->string('observation')->nullable();
			$table->integer('agent_id')->unsigned();
			$table->timestamps(2);
			$table->softDeletes('deleted_at',2);
		});
	}

	public function down()
	{
		Schema::drop('experiences');
	}
}
