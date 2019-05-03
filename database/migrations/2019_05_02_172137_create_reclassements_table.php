<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReclassementsTable extends Migration {

	public function up()
	{
		Schema::create('reclassements', function(Blueprint $table) {
			$table->increments('id');
			$table->string('ref', 15);
			$table->date('date');
			$table->integer('angent_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('reclassements');
	}
}