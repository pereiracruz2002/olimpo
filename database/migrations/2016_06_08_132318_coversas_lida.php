<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CoversasLida extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conversas', function ($table) {
           $table->boolean('lida');
           $table->index('lida');
           $table->index('created_at');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conversas', function ($table) {
           $table->dropIndex('lida');
        });

    }
}
