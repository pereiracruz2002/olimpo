<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDenunciarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denunciar', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('animais_id')->unsigned();
            $table->integer('denunciante')->unsigned();
            $table->text("denuncia");
            $table->timestamps();


            $table->foreign('animais_id')
                ->references('animais_id')->on('animais')
                ->onDelete('cascade');


            $table->foreign('denunciante')
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
        Schema::drop('denunciar');
    }
}
