<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('users_id');
            $table->string('nome');
            $table->string('apelido')->nullable();
            $table->string('email');
            $table->string('senha');
            $table->string('cpf');
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->integer('perfis_id')->unsigned();
            $table->bigInteger('fb_userid')->nullable();
            $table->string('imagem')->nullable();
            $table->timestamps();

            $table->foreign('perfis_id')
                ->references('perfis_id')->on('perfis')
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
        Schema::drop('users');
    }
}
