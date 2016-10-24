<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;

class Conversas_combinacoes extends Model
{
    protected $table = 'conversas_combinacoes';
    protected $primaryKey = "conversas_combinacoes_id";

    protected $fillable = [
        'sala',
        'mensagem',
        'animais_id',
    ];


    public function salas()
    {
        return $this->belongsTo(Salas::class);
    }

    public function animais()
    {
        return $this->belongsTo(Animais::class);
    }
}
