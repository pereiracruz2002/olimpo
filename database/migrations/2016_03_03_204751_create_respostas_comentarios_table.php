<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespostasComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respostas_comentarios', function (Blueprint $table) {
            $table->increments('respostas_comentarios_id');
            $table->text('comentario');
            $table->integer("comentarios_servicos_id")->unsigned();
            $table->integer("users_id")->unsigned();
            $table->timestamps();

            $table->foreign('users_id')
                ->references('users_id')->on('users')
                ->onDelete('cascade');

            $table->foreign('comentarios_servicos_id')
                ->references('comentarios_servicos_id')->on('comentarios_servicos')
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
        Schema::drop('respostas_comentarios');
    }
}
