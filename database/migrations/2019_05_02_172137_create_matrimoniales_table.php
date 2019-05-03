<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatrimonialesTable extends Migration {

	public function up()
	{
		Schema::create('matrimoniales', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 20);
		});
	}

	public function down()
	{
		Schema::drop('matrimoniales');
	}
}