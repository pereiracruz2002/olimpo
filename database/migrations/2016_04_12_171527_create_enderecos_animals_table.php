<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecosAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos_animais', function (Blueprint $table) {
            $table->increments('enderecos_animal_id');
            $table->integer('animais_id')->unsigned();
            $table->string('endereco');
            $table->string('bairro');
            $table->string('complemento')->nullable();
            $table->string('cidade');
            $table->string('estado');
            $table->string('cep');
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->timestamps();

            $table->foreign('animais_id')
                ->references('animais_id')
                ->on('animais')
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
        Schema::drop('enderecos_animais');
    }
}
