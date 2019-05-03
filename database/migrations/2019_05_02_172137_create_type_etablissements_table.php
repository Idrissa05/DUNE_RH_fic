<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTypeEtablissementsTable extends Migration {

	public function up()
	{
		Schema::create('type_etablissements', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 20);
		});
	}

	public function down()
	{
		Schema::drop('type_etablissements');
	}
}