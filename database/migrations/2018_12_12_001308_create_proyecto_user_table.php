<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectoUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_user', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->boolean('escritura')->default(false);
            $table->boolean('lectura')->default(false);

   

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('proyecto_id')->unsigned();
            $table->foreign('proyecto_id')->references('id')->on('proyectos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyecto_user');
    }
}
