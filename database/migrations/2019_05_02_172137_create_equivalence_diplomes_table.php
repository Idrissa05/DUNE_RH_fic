<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEquivalenceDiplomesTable extends Migration {

	public function up()
	{
		Schema::create('equivalence_diplomes', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 15);
		});
	}

	public function down()
	{
		Schema::drop('equivalence_diplomes');
	}
}
