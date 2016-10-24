<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    protected $table = 'empresas';
    protected $primaryKey = 'empresas_id';


    protected $fillable = array(
        'cnpj',
        'empresa',
        'descricao',
        'nome_fantasia',
        'users_id',
        'imagem',
        'email'
    );

    public function users()
    {
        return $this->belongsTo(Users::class);
    }


    public function enderecos(){
        return $this->hasOne(Enderecos::class);
    }

    public function Users_Servicos(){
        return $this->hasMany(Users_Servicos::class);
    }

}
