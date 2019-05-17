<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEtablissementsTable extends Migration {

	public function up()
	{
		Schema::create('etablissements', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 40);
			$table->integer('secteur_pedagogique_id')->unsigned();
			$table->integer('type_etablissement_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('etablissements');
	}
}
