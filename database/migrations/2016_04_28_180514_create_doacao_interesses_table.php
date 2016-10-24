<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoacaoInteressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doacao_interesses', function (Blueprint $table) {
            $table->increments('doacao_interesses_id');
            $table->integer('users_id')->unsigned();
            $table->integer('doacoes_id')->unsigned();
            $table->timestamps();

            $table->foreign('users_id')
                ->references('users_id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('doacoes_id')
                ->references('doacoes_id')
                ->on('doacoes')
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
        Schema::drop('doacao_interesses');
    }
}
