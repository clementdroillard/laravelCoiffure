<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Disponibilite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disponibilites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coiffeur_id')->unsigned();
            $table->integer('jourSemaine')->unsigned();
            $table->time('heureDebut');
            $table->time('heureFin');
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
        Schema::dropIfExists('disponibilites');
    }
}
