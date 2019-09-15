<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAgentMaladieTable extends Migration {

	public function up()
	{
		Schema::create('agent_maladie', function(Blueprint $table) {
			$table->integer('agent_id')->unsigned();
			$table->integer('maladie_id')->unsigned();
			$table->string('observation')->nullable();
			$table->date('date_observation')->nullable();
			$table->timestamps(2);
			$table->softDeletes('deleted_at',2);
		});
	}

	public function down()
	{
		Schema::drop('agent_maladie');
	}
}
