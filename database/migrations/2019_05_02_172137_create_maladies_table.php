<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMaladiesTable extends Migration {

	public function up()
	{
		Schema::create('maladies', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 150);
		});
	}

	public function down()
	{
		Schema::drop('maladies');
	}
}
