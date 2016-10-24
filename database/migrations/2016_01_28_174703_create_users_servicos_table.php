<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_servicos', function (Blueprint $table) {
            $table->increments('users_servicos_id');
            $table->integer('empresas_id')->unsigned();
            $table->integer('servicos_id')->unsigned();
            $table->integer('enderecos_id')->unsigned();

            $table->text('descricao');
            $table->timestamps();

            $table->foreign('empresas_id')
                ->references('empresas_id')->on('empresas')
                ->onDelete('cascade');

            $table->foreign('servicos_id')
                ->references('servicos_id')->on('servicos')
                ->onDelete('cascade');

            $table->foreign('enderecos_id')
                ->references('enderecos_id')->on('enderecos')
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
        Schema::drop('users_servicos');
    }
}
