<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotationsTable extends Migration {

	public function up()
	{
		Schema::create('notations', function(Blueprint $table) {
			$table->increments('id');
			$table->date('date_debut');
			$table->date('date_fin');
			$table->float('note');
			$table->string('responsable', 30);
			$table->string('observation')->nullable();
			$table->integer('agent_id')->unsigned();
			$table->timestamps(2);
			$table->softDeletes('deleted_at',2);
		});
	}

	public function down()
	{
		Schema::drop('notations');
	}
}
