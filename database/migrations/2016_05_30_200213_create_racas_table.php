<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRacasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('racas', function (Blueprint $table) {
            $table->increments('racas_id');
            $table->string('nome');
            $table->integer('tipos_id')->unsigned();
            $table->timestamps();


            $table->foreign('tipos_id')
                ->references('tipos_id')->on('tipos')
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
        Schema::drop('racas');
    }
}
