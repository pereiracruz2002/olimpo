<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria_doacao extends Model
{
    protected $table = 'categoria_doacaos';
    protected $primaryKey = 'categorias_doacao_id';

    protected $fillable = array(
        'nome',
    );

    public function doacoes(){
        return $this->belongsTo(Doacoes::class);
    }
}
