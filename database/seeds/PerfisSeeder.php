<?php

use Illuminate\Database\Seeder;
use PET\Models\Perfis;

class PerfisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	DB::table('perfis')->where('perfis_id', '>', 0)->delete();
    	Perfis::create(['nome' => 'Admin']);
    	Perfis::create(['nome' => 'Dono']);
    	Perfis::create(['nome' => 'Proprietario']);
    	
    	
        //factory(PET\Models\Perfis::class,4)->create();
    }
}
