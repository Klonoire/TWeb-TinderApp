<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInteraccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interaccions', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('perro_interesado_id')->unsigned();
            $table->foreign('perro_interesado_id')->references('id')->on('perros');
            $table->bigInteger('perro_candidato_id')->unsigned();
            $table->foreign('perro_candidato_id')->references('id')->on('perros');
            $table->char('preferencia');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interaccions');
    }
}
