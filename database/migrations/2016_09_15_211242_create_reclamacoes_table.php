<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReclamacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reclamacoes', function (Blueprint $table) {
            $table->increments('reclamacao_id');
            $table->string('empresa')->nullable();
            $table->string('cnpj', 20);
            $table->string('email');
            $table->string('site');
            $table->string('assunto');
            $table->text('texto');
            $table->integer("users_id")->unsigned();
            $table->integer("empresas_id")->unsigned()->nullable();
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
        Schema::drop('reclamacoes');
    }
}
