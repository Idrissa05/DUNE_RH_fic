<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEcoleFormationsTable extends Migration {

	public function up()
	{
		Schema::create('ecole_formations', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 50);
		});
	}

	public function down()
	{
		Schema::drop('ecole_formations');
	}
}