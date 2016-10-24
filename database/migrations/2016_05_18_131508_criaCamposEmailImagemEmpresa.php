<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaCamposEmailImagemEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function ($table) {
            $table->string('imagem');
            $table->string('email');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empresas', function ($table) {
            $table->dropColumn('imagem');
            $table->dropColumn('email');
        });
    }
}
