<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animais', function (Blueprint $table) {
            $table->increments('animais_id');
            $table->string('nome');
            $table->enum('sexo', ['macho', 'femea']);
            $table->string("raca");
            $table->integer('tipos_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->string('imagem');
            $table->enum('mesma_raca', ['sim', 'nao']);
            $table->double('distancia')->nullable();
            $table->timestamps();

            $table->foreign('tipos_id')
                ->references('tipos_id')->on('tipos')
                ->onDelete('cascade');

            $table->foreign('users_id')
                ->references('users_id')->on('users')
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
        Schema::drop('animais');
    }
}
