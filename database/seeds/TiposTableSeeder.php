<?php

use Illuminate\Database\Seeder;
use PET\Models\Tipos;

class TiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	DB::table('tipos')->where('tipos_id', '>', 0)->delete();
    	Tipos::create(['nome' => 'Cachorro']);
    	Tipos::create(['nome' => 'Gato']);
    	Tipos::create(['nome' => 'Coelho']);
        //factory(PET\Models\Tipos::class,3)->create();
    }
}
