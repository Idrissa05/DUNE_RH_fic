<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDiplomesTable extends Migration {

	public function up()
	{
		Schema::create('diplomes', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 50);
		});
	}

	public function down()
	{
		Schema::drop('diplomes');
	}
}