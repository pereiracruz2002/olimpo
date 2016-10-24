<?php

use Illuminate\Database\Seeder;

class Salas_usuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PET\Models\Salas_usuarios::class,50)->create();
    }
}
