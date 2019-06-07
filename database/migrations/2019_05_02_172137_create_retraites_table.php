<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRetraitesTable extends Migration {

	public function up()
	{
		Schema::create('retraites', function(Blueprint $table) {
			$table->increments('id');
			$table->date('date');
			$table->string('ref_decision', 15);
			$table->date('date_decision');
            $table->string('lieu', 15);
            $table->string('contact', 30);
			$table->string('observation')->nullable();
			$table->integer('agent_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('retraites');
	}
}
