<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(TiposTableSeeder::class);
        $this->call(PerfisSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ServicosTableSeeder::class);
        $this->call(AnimaisTableSeeder::class);
        $this->call(EmpresasTableSeeder::class);
        $this->call(EnderecosTableSeeder::class);
        $this->call(Users_ServicosTableSeeder::class);
        $this->call(AvaliacaoTableSeeder::class);
        $this->call(comentariosTableSeeder::class);
        $this->call(Respostas_ComentariosTableSeeder::class);
        $this->call(SalasTableSeeder::class);
        $this->call(ConversasTableSeeder::class);
        $this->call(Salas_usuariosTableSeeder::class);
        $this->call(Endereco_animaisTableSeeder::class);
        $this->call(Categoria_doacaoTableSeeder::class);



    }
}
