<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentTypeEnseignementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_type_enseignement', function (Blueprint $table) {
            $table->integer('agent_id')->unsigned();
			$table->integer('type_enseignement_id')->unsigned();
			$table->date('date');
			$table->timestamps();
			$table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_type_enseignement');
    }
}
