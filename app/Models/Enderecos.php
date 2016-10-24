<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;

class Enderecos extends Model
{
    protected $table = 'enderecos';
    protected $primaryKey = 'enderecos_id';

    protected $fillable = array(
        'empresas_id',
        'endereco',
        'bairro',
        'complemento',
        'cidade',
        'estado',
        'cep',
        'telefone',
        'celular',
        'latitude',
        'longitude'
    );

    public function empresas()
    {
        return $this->belongsTo(Empresas::class);
    }
}
