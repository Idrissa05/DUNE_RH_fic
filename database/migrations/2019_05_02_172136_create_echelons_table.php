<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEchelonsTable extends Migration {

	public function up()
	{
		Schema::create('echelons', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 40);
        $table->string('description', 40)->nullable();
			$table->integer('classe_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('echelons');
	}
}
