<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaCampoSalasEmTipo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salas', function ($table) {
            $table->enum('tipo',['doacões','serviços'])->default("serviços");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salas', function ($table) {
            $table->dropColumn('tipo');
        });
    }
}
