<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacoes', function (Blueprint $table) {
            
            $table->increments('notificacao_id');
            $table->text('mensagem');
            $table->integer('users_id')->unsigned();
            $table->text('extras');
            $table->string('tipo');
            $table->string('url');
            $table->string('visto');
            $table->timestamps();



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
        Schema::drop('notificacoes');
    }
}
