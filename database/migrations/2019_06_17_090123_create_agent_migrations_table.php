<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentMigrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_migrations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_id')->unsigned();
            $table->integer('grade_id')->unsigned();
            $table->string('matricule', 30);
            $table->string('type', 30);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_migrations');
    }
}
