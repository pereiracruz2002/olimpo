<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;
use PET\Models\Respostas_comentarios;

class Comentarios_servicos extends Model
{
    protected $table = 'comentarios_servicos';
    protected $primaryKey = 'comentarios_servicos_id';
    protected $fillable = array(
        'comentario',
        'users_id',
        'empresas_id'
    );

    public function users(){

        return $this->belongsTo(Users::class);
    }

    public function respostas(){
        return $this->hasMany(Respostas_comentarios::class);
    }
}
