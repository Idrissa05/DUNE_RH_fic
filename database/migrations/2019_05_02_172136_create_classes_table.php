<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassesTable extends Migration {

	public function up()
	{
		Schema::create('classes', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 40);
			$table->string('description', 40)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('classes');
	}
}
