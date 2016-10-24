<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->increments('enderecos_id');
            $table->integer('empresas_id')->unsigned();
            $table->foreign('empresas_id')
                   ->references('empresas_id')
                  ->on('empresas')
                  ->onDelete('cascade');
            $table->string('endereco');
            $table->string('bairro');
            $table->string('complemento')->nullable();
            $table->string('cidade');
            $table->string('estado');
            $table->string('cep');
            $table->string('telefone');
            $table->string('celular');
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('enderecos');
    }
}
