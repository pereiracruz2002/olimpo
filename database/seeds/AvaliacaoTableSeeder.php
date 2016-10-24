<?php

use Illuminate\Database\Seeder;

class AvaliacaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PET\Models\Avaliacao::class,50)->create();
    }
}
