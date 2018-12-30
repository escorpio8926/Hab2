<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cambiarrelaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('links', function (Blueprint $table) {
            //
            $table->integer('actividad_id')->unsigned()->after('id');
            $table->foreign('actividad_id')->references('id')->on('actividades')->onDelete('SET NULL');
           

        });
        Schema::table('tasks', function($table) {
            $table->dropColumn('proyecto_id');
         });
        Schema::table('tasks', function (Blueprint $table) {
            //
            $table->integer('actividad_id')->unsigned()->after('id');
            $table->foreign('actividad_id')->references('id')->on('actividades')->onDelete('SET NULL');
           
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
