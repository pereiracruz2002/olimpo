<?php

use Illuminate\Database\Seeder;

class Endereco_animaisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PET\Models\Enderecos_animais::class,50)->create();
    }
}
