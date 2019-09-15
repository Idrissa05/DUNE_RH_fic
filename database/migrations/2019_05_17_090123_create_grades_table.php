<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_id')->unsigned();
            $table->integer('cadre_id')->unsigned();
            $table->integer('corp_id')->unsigned();
            $table->integer('fonction_id')->unsigned();
            $table->integer('category_auxiliaire_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('classe_id')->unsigned()->nullable();
            $table->integer('echelon_id')->unsigned()->nullable();
            $table->string('type', 30);
            $table->string('ref_avancement', 30)->nullable();
            $table->date('date_decision_avancement')->nullable();
            $table->string('observation_avancement')->nullable();
            $table->string('ref_reclassement', 15)->nullable();
            $table->date('date_reclassement')->nullable();
            $table->string('ref_titularisation', 30)->nullable();
            $table->date('date_titularisation')->nullable();
            $table->string('ref_engagement', 30)->nullable()->index();
            $table->date('date_engagement')->nullable();
            $table->integer('indice_id')->unsigned()->nullable();
            $table->timestamps(2);
            $table->softDeletes('deleted_at',2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
