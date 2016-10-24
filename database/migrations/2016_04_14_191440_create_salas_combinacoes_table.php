<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalasCombinacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salas_combinacoes', function (Blueprint $table) {
            $table->increments('salas_combinacoes_id');
            $table->integer("animal1")->unsigned();
            $table->integer("animal2")->unsigned();
            $table->timestamps();

            $table->foreign('animal1')
                ->references('animais_id')->on('animais')
                ->onDelete('cascade');

            $table->foreign('animal2')
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
        Schema::drop('salas_combinacoes');
    }
}
