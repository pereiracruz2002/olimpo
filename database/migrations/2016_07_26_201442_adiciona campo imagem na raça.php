<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionaCampoImagemNaRaça extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('racas', function ($table) {
          $table->text('imagem');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('racas', function ($table) {
           $table->dropColumn('imagem');
        });
    }
}
