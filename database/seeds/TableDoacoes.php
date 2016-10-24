<?php

use Illuminate\Database\Seeder;

class TableDoacoes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	
    	
        factory(PET\Models\Doacoes::class,20)->create();
    }
}


