<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Illuminate\Support\Facades\Crypt;




$factory->define(PET\Models\Users::class, function (Faker\Generator $faker) {

    $perfil = DB::table('perfis')->orderBy(DB::raw("RAND()"))->take(1)->first();
    return [
        'nome' => $faker->name,
        'email' => $faker->email,
        'senha' => Crypt::encrypt(123),
        'apelido' => $faker->name,
        'cpf'=>$faker->randomNumber($nbDigits = NULL),
        'latitude'=>$faker->latitude,
        'longitude'=>$faker->longitude,
        'perfis_id' => $perfil->perfis_id,
        'imagem' => $faker->imageUrl($width = 640, $height = 480),
    ];
});


$factory->define(PET\Models\Tipos::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->word,
    ];
});

$factory->define(PET\Models\Servicos::class, function (Faker\Generator $faker) {
    $tipo = DB::table('tipos')->orderBy(DB::raw("RAND()"))->take(1)->first();
    return [
        'nome' => $faker->word,
        'tipos_id' => $tipo->tipos_id,
    ];
});

$factory->define(PET\Models\Animais::class, function (Faker\Generator $faker) {
    $tipo = DB::table('tipos')->orderBy(DB::raw("RAND()"))->take(1)->first();
    $user = DB::table('users')->orderBy(DB::raw("RAND()"))->take(1)->first();
    return [
        'nome' => $faker->firstName,
        'sexo' => 'macho',
        'raca' => $faker->word,
        'tipos_id' => $tipo->tipos_id,
        'users_id' => $user->users_id,
        'imagem' => $faker->imageUrl($width = 640, $height = 480),
        'mesma_raca'=>'sim',
        'distancia'=>5
    ];
});

$factory->define(PET\Models\Users_Servicos::class, function (Faker\Generator $faker) {
    $servico = DB::table('servicos')->orderBy(DB::raw("RAND()"))->take(1)->first();
    //$user = DB::table('users')->orderBy(DB::raw("RAND()"))->take(1)->first();
    $empresas = DB::table('empresas')->orderBy(DB::raw("RAND()"))->take(1)->first();
    return [
        'servicos_id' => $servico->servicos_id,
        'empresas_id' => $empresas->empresas_id,
        'descricao' => $faker->realText,
    ];
});


$factory->define(PET\Models\Enderecos_animais::class, function (Faker\Generator $faker) {

    $animal = DB::table('animais')->orderBy(DB::raw("RAND()"))->take(1)->first();
    return [
        'animais_id' => $animal->animais_id,
        'endereco' => $faker->address,
        'cep'=>$faker->postcode,
        'bairro' => $faker->streetName,
        'complemento'=>$faker->randomLetter,
        'latitude'=>$faker->latitude,
        'longitude'=>$faker->longitude,
        'cidade' => $faker->city,
        'estado' => $faker->state,
    ];
});



$factory->define(PET\Models\Empresas::class, function (Faker\Generator $faker) {
    $user = DB::table('users')->orderBy(DB::raw("RAND()"))->take(1)->first();
    return [
        'cnpj' =>$faker->creditCardNumber,
        'nome_fantasia' => $faker->word,
        'users_id' => $user->users_id,
    ];
});


$factory->define(PET\Models\Enderecos::class, function (Faker\Generator $faker) {

    $empresas = DB::table('empresas')->orderBy(DB::raw("RAND()"))->take(1)->first();
    return [
        'empresas_id' => $empresas->empresas_id,
        'endereco' => $faker->address,
        'cep'=>$faker->postcode,
        'telefone' => $faker->phoneNumber ,
        'celular' => $faker->phoneNumber,
        'bairro' => $faker->streetName,
        'complemento'=>$faker->randomLetter,
        'latitude'=>$faker->latitude,
        'longitude'=>$faker->longitude,
        'cidade' => $faker->city,
        'estado' => $faker->state,
    ];
});

$factory->define(PET\Models\Avaliacao::class, function (Faker\Generator $faker) {
    $users_servicos = DB::table('users_servicos')->orderBy(DB::raw("RAND()"))->take(1)->first();
    $user = DB::table('users')->orderBy(DB::raw("RAND()"))->take(1)->first();
    return [
        'like' => 'sim',
        'users_servicos_id' => $users_servicos->users_servicos_id,
        'users_id' => $user->users_id
    ];
});

$factory->define(PET\Models\Comentarios_servicos::class, function (Faker\Generator $faker) {
    $users_servicos = DB::table('users_servicos')->orderBy(DB::raw("RAND()"))->take(1)->first();
    $user = DB::table('users')->orderBy(DB::raw("RAND()"))->take(1)->first();
    return [
        'comentario' => $faker->word,
        'users_id' => $user->users_id,
        'users_servicos_id' => $users_servicos->users_servicos_id
    ];
});


$factory->define(PET\Models\Respostas_comentarios::class, function (Faker\Generator $faker) {
    $comentarios_servicos = DB::table('comentarios_servicos')->orderBy(DB::raw("RAND()"))->take(1)->first();
    $user = DB::table('users')->orderBy(DB::raw("RAND()"))->take(1)->first();
    return [
        'comentario' => $faker->word,
        'users_id' => $user->users_id,
        'comentarios_servicos_id' => $comentarios_servicos->comentarios_servicos_id
    ];
});


$factory->define(PET\Models\Salas::class, function (Faker\Generator $faker) {
    return [
        'status' => $faker->word

    ];
});

$factory->define(PET\Models\Conversas::class, function(Faker\Generator $faker){

    $users = DB::table('users')->orderBy(DB::raw("RAND()"))->take(1)->first();
    $salas = DB::table('salas')->orderBy(DB::raw("RAND()"))->take(1)->first();

    return [
        'salas_id'=>$salas->salas_id,
        'users_id'=>$users->users_id,
        'mensagem' => $faker->text,
    ];
});


$factory->define(PET\Models\Salas_usuarios::class, function(Faker\Generator $faker){

    $users = DB::table('users')->orderBy(DB::raw("RAND()"))->take(1)->first();
    $salas = DB::table('salas')->orderBy(DB::raw("RAND()"))->take(1)->first();

    return [
        'salas_id'=>$salas->salas_id,
        'users_id'=>$users->users_id
    ];
});



$factory->define(PET\Models\Categoria_doacao::class, function(Faker\Generator $faker){

    return [
        'nome' => $faker->word,
    ];
});


$factory->define(PET\Models\Doacoes::class, function(Faker\Generator $faker){

    $tipo = DB::table('tipos')->orderBy(DB::raw("RAND()"))->take(1)->first();
    $categoria = DB::table('categoria_doacaos')->orderBy(DB::raw("RAND()"))->take(1)->first();
    $users = DB::table('users')->orderBy(DB::raw("RAND()"))->take(1)->first();

    return [
        'titulo' => $faker->word,
        'descricao' => $faker->word,
        'tipo' => $tipo->tipos_id,
        'categoria' => $categoria->categorias_doacao_id,
        'status' => "Ativo",
        'imagem' => $faker->imageUrl($width = 640, $height = 480),
        'users_id' => $users->users_id
    ];
});
