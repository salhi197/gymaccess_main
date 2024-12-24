<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->date('debut')->nullable();
            $table->date('fin')->nullable();
            $table->integer('reste')->nullable();
            $table->integer('nbsseance')->nullable();
            $table->string('membre')->nullable();
            $table->string('abonnement')->nullable();
            $table->string('etat')->nullable();
            $table->integer('total')->nullable();
            $table->integer('remise')->nullable();
            $table->integer('nbrmois')->nullable();    
            $table->integer('versement')->nullable();    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscriptions');
    }
}
