<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;

class Respostas_comentarios extends Model
{

    protected $table = 'respostas_comentarios';
    protected $primaryKey = 'respostas_comentarios_id';

    protected $fillable = [
        'comentario',
        'comentarios_servicos_id',
        'users_id',
    ];

    public function users()
    {
        return $this->belongsTo(Users::class);
    }


    public function comentarios_servicos()
    {
        return $this->belongsTo(ComentariosServicos::class);
    }

}
