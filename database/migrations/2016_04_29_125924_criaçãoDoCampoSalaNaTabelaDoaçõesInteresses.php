<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaçãoDoCampoSalaNaTabelaDoaçõesInteresses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doacao_interesses', function ($table) {
           $table->integer('salas_id')->unsigned();
           $table->foreign('salas_id')->references('salas_id')->on('salas')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('doacao_interesses', function ($table) {
            $table->dropForeign('doacao_interesses_salas_id_foreign');
            $table->dropColumn('salas_id');
        });
    }
}
