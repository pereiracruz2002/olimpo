<?php

use Illuminate\Database\Seeder;
use PET\Models\Servicos;

class ServicosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	

    	DB::table('servicos')->where('tipos_id', '>', 0)->delete();
    	Servicos::create(['nome' => 'Adestramento','tipos_id'=>1]);
    	Servicos::create(['nome' => 'Banho','tipos_id'=>1]);
    	Servicos::create(['nome' => 'Veterinário','tipos_id'=>1]);
        //factory(PET\Models\Servicos::class,10)->create();
    }
}
