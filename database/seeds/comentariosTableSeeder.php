<?php

use Illuminate\Database\Seeder;

class comentariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PET\Models\Comentarios_servicos::class,100)->create();
    }
}
