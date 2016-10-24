<?php

use Illuminate\Database\Seeder;

class ConversasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PET\Models\Conversas::class,10)->create();
    }
}
