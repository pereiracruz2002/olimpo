<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;

class Conversas extends Model
{
    protected $table = 'conversas';
    protected $primaryKey = "conversas_id";

    protected $fillable = [
        'users_id',
        'salas_id',
        'mensagem',
    ];

    public function users()
    {
        return $this->belongsTo(Users::class);
    }

    public function salas()
    {
        return $this->belongsTo(Salas::class);
    }
}


