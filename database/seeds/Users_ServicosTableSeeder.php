<?php

use Illuminate\Database\Seeder;

class Users_ServicosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PET\Models\Users_Servicos::class,50)->create();
    }
}
