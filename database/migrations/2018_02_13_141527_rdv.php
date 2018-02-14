<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Rdv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rdvs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coiffeur_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('prestation_id')->unsigned();
            $table->dateTime('dateDebut');
            $table->dateTime('dateFin');
            $table->timestamps();
            $table->foreign('prestation_id')->references('id')->on('prestations');
            $table->foreign('client_id')->references('id')->on('clients');
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
        Schema::dropIfExists('rdvs');
    }
}
