<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAgentEchelonsTable extends Migration {

	public function up()
	{
		Schema::create('agent_echelons', function(Blueprint $table) {
			$table->integer('agent_id')->unsigned();
			$table->integer('echelon_id')->unsigned();
			$table->string('ref_avancement', 30);
			$table->date('date_decision');
			$table->string('observation')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('agent_echelons');
	}
}