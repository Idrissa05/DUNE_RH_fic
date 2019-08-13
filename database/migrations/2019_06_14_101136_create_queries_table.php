<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQueriesTable extends Migration {

	public function up()
	{
		Schema::create('queries', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 100);
            $table->text('sql');
            $table->text('fields')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('queries');
	}
}
