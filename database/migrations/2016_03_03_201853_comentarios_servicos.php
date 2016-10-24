<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ComentariosServicos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios_servicos', function (Blueprint $table) {
            $table->increments('comentarios_servicos_id');
            $table->string("comentario");
            $table->integer("users_id")->unsigned();
            $table->integer("empresas_id")->unsigned();
            $table->timestamps();


            $table->foreign('users_id')
                ->references('users_id')->on('users')
                ->onDelete('cascade');

            $table->foreign('empresas_id')
                ->references('empresas_id')->on('empresas')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comentarios_servicos');
    }
}
