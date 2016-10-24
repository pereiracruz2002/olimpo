<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversasCombinacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversas_combinacoes', function (Blueprint $table) {
            $table->increments('conversas_combinacoes_id');
            $table->integer("sala")->unsigned();
            $table->text("mensagem");
            $table->integer("animais_id")->unsigned();
            $table->timestamps();

            $table->foreign('sala')
                ->references('salas_combinacoes_id')->on('salas_combinacoes')
                ->onDelete('cascade');

            $table->foreign('animais_id')
                ->references('animais_id')->on('animais')
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
        Schema::drop('conversas_combinacoes');
    }
}
