<?php

use Illuminate\Database\Seeder;

class Respostas_ComentariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PET\Models\Respostas_comentarios::class,50)->create();
    }
}
