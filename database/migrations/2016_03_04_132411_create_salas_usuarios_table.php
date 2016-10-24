<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalasUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salas_usuarios', function (Blueprint $table) {
            $table->increments('salas_usuarios_id');
            $table->integer('users_id')->unsigned();
            $table->integer('salas_id')->unsigned();
            $table->foreign('users_id')
                ->references('users_id')->on('users')
                ->onDelete('cascade');

            $table->foreign('salas_id')
                ->references('salas_id')->on('salas')
                ->onDelete('cascade');
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
        Schema::drop('salas_usuarios');
    }
}
