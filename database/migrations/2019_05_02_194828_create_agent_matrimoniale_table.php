<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAgentMatrimonialeTable extends Migration {

	public function up()
	{
		Schema::create('agent_matrimoniale', function(Blueprint $table) {
			$table->integer('agent_id')->unsigned();
			$table->integer('matrimoniale_id')->unsigned();
			$table->date('date');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('agent_matrimoniale');
	}
}
