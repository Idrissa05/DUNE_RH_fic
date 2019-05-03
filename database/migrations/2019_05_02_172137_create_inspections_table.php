<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInspectionsTable extends Migration {

	public function up()
	{
		Schema::create('inspections', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 30);
			$table->integer('departement_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('inspections');
	}
}
