<?php

use Illuminate\Database\Seeder;

class SalasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PET\Models\Salas::class,10)->create();
    }
}
