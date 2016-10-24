<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversas', function (Blueprint $table) {
            $table->increments('conversas_id');
            $table->integer('users_id')->unsigned();
            $table->integer('salas_id')->unsigned();
            $table->text('mensagem');
            $table->timestamps();

            $table->foreign('users_id')
                ->references('users_id')->on('users')
                ->onDelete('cascade');

            $table->foreign('salas_id')
                ->references('salas_id')->on('salas')
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
        Schema::drop('conversas');
    }
}
