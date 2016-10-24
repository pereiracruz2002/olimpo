<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvaliacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliacao', function (Blueprint $table) {
            $table->increments('avalicao_id');
            $table->enum('like', ['sim', 'não']);
            $table->integer('empresas_id')->unsigned();
            $table->integer('users_id')->unsigned();
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
        Schema::drop('avaliacao');
    }
}
