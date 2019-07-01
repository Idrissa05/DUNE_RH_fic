<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMinisteresTable extends Migration {

	public function up()
	{
		Schema::create('ministeres', function(Blueprint $table) {
			$table->increments('id');
            $table->string('abreviation', 10);
			$table->string('name', 100);
		});
	}

	public function down()
	{
		Schema::drop('ministeres');
	}
}
