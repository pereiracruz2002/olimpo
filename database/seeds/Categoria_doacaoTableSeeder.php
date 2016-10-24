<?php

use Illuminate\Database\Seeder;
use PET\Models\Categoria_doacao;

class Categoria_doacaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	
    	Categoria_doacao::create(['nome' => 'Animais']);
    	Categoria_doacao::create(['nome' => 'Alimentos']);
    	Categoria_doacao::create(['nome' => 'Remédios']);
    	Categoria_doacao::create(['nome' => 'Objetos']);
        //factory(PET\Models\Categoria_doacao::class,3)->create();
    }
}
