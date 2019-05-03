<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCongesTable extends Migration {

	public function up()
	{
		Schema::create('conges', function(Blueprint $table) {
			$table->increments('id');
			$table->string('ref_decision', 20)->index();
			$table->date('date_debut');
			$table->date('date_fin');
			$table->string('observation')->nullable();
			$table->integer('agent_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('conges');
	}
}
