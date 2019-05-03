<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDecesTable extends Migration {

	public function up()
	{
		Schema::create('deces', function(Blueprint $table) {
			$table->increments('id');
			$table->date('date');
			$table->string('ref_document', 20);
			$table->string('observation')->nullable();
			$table->integer('agent_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('deces');
	}
}
