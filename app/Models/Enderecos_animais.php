<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;

class Enderecos_animais extends Model
{
    protected $table = 'enderecos_animais';
    protected $primaryKey = 'enderecos_animal_id';

    protected $fillable = array(
        'animais_id',
        'endereco',
        'bairro',
        'complemento',
        'cidade',
        'estado',
        'cep',
        'latitude',
        'longitude'
    );

    public function animais()
    {
        return $this->belongsTo(Animais::class);
    }

  
}
