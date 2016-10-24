<?php

use Illuminate\Database\Seeder;

class AnimaisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PET\Models\Animais::class,50)->create();
    }
}
