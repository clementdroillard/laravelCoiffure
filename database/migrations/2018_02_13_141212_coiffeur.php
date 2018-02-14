<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Coiffeur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coiffeurs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('salon_id')->unsigned();
            $table->string('nom');
            $table->string('prenom');
            $table->string('specialite');
            $table->timestamps();
            $table->foreign('salon_id')->references('id')->on('salons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coiffeurs');
    }
}
