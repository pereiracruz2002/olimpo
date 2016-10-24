<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ColocarCampoPerfil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
           $table->enum('perfil', ['usuario', 'empresa'])->default("usuario");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('users', function ($table) {
           $table->dropColumn('perfil');
        });
        
    }
}
