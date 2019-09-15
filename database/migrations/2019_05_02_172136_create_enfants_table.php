<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEnfantsTable extends Migration {

	public function up()
	{
		Schema::create('enfants', function(Blueprint $table) {
			$table->increments('id');
			$table->string('prenom', 50);
			$table->date('date_naiss');
			$table->string('lieu_naiss', 30)->nullable();
            $table->string('ref_acte_naiss', 30)->nullable();
			$table->char('sexe', 1);
			$table->integer('agent_id')->unsigned();
			$table->timestamps(2);
			$table->softDeletes('deleted_at',2);
		});
	}

	public function down()
	{
		Schema::drop('enfants');
	}
}
