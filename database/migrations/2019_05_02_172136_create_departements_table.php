<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDepartementsTable extends Migration {

	public function up()
	{
		Schema::create('departements', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 30);
			$table->integer('region_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('departements');
	}
}
