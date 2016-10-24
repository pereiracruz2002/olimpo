<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReclamacoesRespostasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reclamacoes_respostas', function (Blueprint $table) {
            $table->increments('reclamacoes_resposta_id');
            $table->text('texto');
            $table->integer("reclamacao_id")->unsigned();
            $table->integer("users_id")->unsigned()->nullable();
            $table->integer("empresas_id")->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('reclamacao_id')
                ->references('reclamacao_id')->on('reclamacoes')
                ->onDelete('cascade');

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
        Schema::drop('reclamacoes_respostas');
    }
}
