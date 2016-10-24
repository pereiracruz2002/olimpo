<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ColocaEndereçoUsúario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
           $table->string('endereco');
           $table->string('bairro');
           $table->string('complemento');
           $table->string('cidade');
           $table->string('estado');
           $table->string('cep');
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
         $table->dropColumn('endereco');
         $table->dropColumn('bairro');
         $table->dropColumn('complemento');
         $table->dropColumn('cidade');
         $table->dropColumn('estado');
         $table->dropColumn('cep');
     });
    }
}
