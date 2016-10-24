<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Users extends Model
{
    protected $table = 'users';
    protected $primaryKey = "users_id";
    protected $fillable = [
        'nome',
        'users_id',
        'cpf',
        'apelido',
        'email',
        'senha',
        'perfis_id',
        'fb_userid',
        'imagem',
        'player_id',
        'token',
        'perfil',
        'referencia'
    ];

    public function perfis()
    {
        return $this->hasOne(Perfis::class);
    }

    public function animais() 
    {
        return $this->hasMany(Animais::class);
    }

    public function enderecos()
    {
        return $this->hasMany(Enderecos::class);
    }

    public function servicos() 
    {
        return $this->hasMany(Servicos::class);
    }

    public function getMyServices($servicos_id,$latitude,$longitude)
    {

        $users = DB::table('users')
            ->select(DB::raw('users.users_id,users_servicos.users_servicos_id, users.nome, users.apelido, users.email, users.imagem,empresas.*,enderecos.*, servicos.servicos_id, servicos.nome as servico,
                (6371 * acos (cos ( radians('.$latitude.') )* cos( radians( enderecos.latitude ) )* cos( radians( enderecos.longitude ) - radians('.$longitude.') )+ sin ( radians('.$latitude.') ) * sin( radians( enderecos.latitude ) ))) as distancia'))
            ->join("empresas","empresas.users_id",'=',"users.users_id")
            ->join('users_servicos', 'users_servicos.empresas_id', '=', 'empresas.empresas_id')
            ->join('servicos', 'servicos.servicos_id', '=', 'users_servicos.servicos_id')
            ->join('enderecos','enderecos.empresas_id','=','empresas.empresas_id')
            ->where('users_servicos.servicos_id', $servicos_id)
            ->having('distancia',' <','20')
            ->orderBy('distancia', 'desc')
            ->get();


        return $users;
    }

    public function cadastrarUsuario($data) 
    {
        $perfil = DB::table('perfis')->where('nome', 'Dono')->first();
        $data['perfis_id'] = $perfil->perfis_id;
        return DB::table('users')->insertGetId($data);

    }

    public function updatePosition($coords, $users_id) 
    {
        DB::table('users')->where('users_id', $users_id)->update($coords);
    }

}
