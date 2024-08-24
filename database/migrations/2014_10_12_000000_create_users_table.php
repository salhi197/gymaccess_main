<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->text('numero')->nullable();
            $table->text('_date')->nullable();
            $table->text('lieu')->nullable();
            $table->text('matricule')->nullable();
            $table->text('client')->nullable();
            $table->text('ville')->nullable();
            $table->integer('prix');
            $table->integer('quantite');
            $table->integer('avance');            
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
        Schema::dropIfExists('users');
    }
}
