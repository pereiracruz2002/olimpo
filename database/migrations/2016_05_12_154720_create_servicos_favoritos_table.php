<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicosFavoritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicos_favoritos', function (Blueprint $table) {
            $table->increments('servicos_favoritos_id');
            $table->integer('empresas_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->timestamps();

            $table->foreign('empresas_id')
                ->references('empresas_id')->on('empresas')
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
        Schema::drop('servicos_favoritos');
    }
}
