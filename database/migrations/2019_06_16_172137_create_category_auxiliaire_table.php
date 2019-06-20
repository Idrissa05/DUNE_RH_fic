<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryAuxiliaireTable extends Migration {

	public function up()
	{
		Schema::create('category_auxiliaires', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 50);
		});
	}

	public function down()
	{
		Schema::drop('category_auxiliaires');
	}
}
