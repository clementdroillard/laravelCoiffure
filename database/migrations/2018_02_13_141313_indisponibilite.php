<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Indisponibilite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indisponibilites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coiffeur_id')->unsigned();
            $table->dateTime('dateDebut');
            $table->dateTime('dateFin');
            $table->timestamps();
            $table->foreign('coiffeur_id')->references('id')->on('coiffeurs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indisponibilites');
    }
}
