<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNiveauEtudesTable extends Migration {

	public function up()
	{
		Schema::create('niveau_etudes', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 15);
		});
	}

	public function down()
	{
		Schema::drop('niveau_etudes');
	}
}