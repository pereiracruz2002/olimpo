<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ColocaCampoUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doacoes', function ($table) {
           $table->integer('users_id')->unsigned();
           $table->foreign('users_id')->references('users_id')->on('users')->onDelete('cascade');
        });



      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('doacoes', function ($table) {
            $table->dropForeign('doacoes_users_id_foreign');
            $table->dropColumn('users_id');
        });
    }
}
