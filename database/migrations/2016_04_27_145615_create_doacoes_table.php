<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doacoes', function (Blueprint $table) {
            $table->increments('doacoes_id');
            $table->string("titulo");
            $table->text('descricao');
            $table->integer('tipo')->unsigned();
            $table->integer('categoria')->unsigned();
            $table->enum('status', ['Ativo', 'Inativo']);
            $table->timestamps();

            $table->foreign('tipo')
                ->references('tipos_id')
                ->on('tipos')
                ->onDelete('cascade');

            $table->foreign('categoria')
                ->references('categorias_doacao_id')
                ->on('categoria_doacaos')
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
        Schema::drop('doacoes');
    }
}
