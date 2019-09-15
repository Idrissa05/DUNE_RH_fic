<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAffectationsTable extends Migration {

	public function up()
	{
		Schema::create('affectations', function(Blueprint $table) {
			$table->increments('id');
			$table->string('ref', 40)->index();
			$table->date('date');
			$table->date('date_prise_effet');
			$table->string('observation')->nullable();
			$table->integer('agent_id')->unsigned();
			$table->integer('etablissement_id')->unsigned();
			$table->timestamps(2);
			$table->softDeletes('deleted_at',2);
		});
	}

	public function down()
	{
		Schema::drop('affectations');
	}
}
