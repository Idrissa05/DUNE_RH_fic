<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAgentMaladiesTable extends Migration {

	public function up()
	{
		Schema::create('agent_maladies', function(Blueprint $table) {
			$table->integer('agent_id')->unsigned();
			$table->integer('maladie_id')->unsigned();
			$table->string('observation')->nullable();
			$table->date('date_observation')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('agent_maladies');
	}
}