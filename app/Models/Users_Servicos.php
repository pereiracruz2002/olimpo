<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;

class Users_Servicos extends Model
{
    protected $table = 'users_servicos';
    protected $primaryKey = "users_servicos_id";
    protected $fillable = [
        'empresas_id',
        'servicos_id',
        'descricao',
        'enderecos_id'
    ];

    public function users(){

        return $this->belongsTo(Users::class);
    }

    public function servicos(){

        return $this->belongsTo(Servicos::class);
    }

    public function enderecos(){

        return $this->belongsTo(Enderecos::class);
    }

    public function empresas(){

        return $this->hasOne(Empresas::class,'empresas_id',"empresas_id");
    }

    public function servicos_favoritos(){
        return $this->hasMany(Servicos_favoritos::class,'users_servicos_id');
    }


}
