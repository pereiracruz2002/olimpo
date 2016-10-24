<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('matches_id');
            $table->integer("animal1")->unsigned();
            $table->integer("animal2")->unsigned();
            $table->timestamps();

            $table->foreign('animal1')
                ->references('animais_id')->on('animais')
                ->onDelete('cascade');

            $table->foreign('animal2')
                ->references('animais_id')->on('animais')
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
        Schema::drop('matches');
    }
}
