<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;

class Salas_usuarios extends Model
{
    protected $table = 'salas_usuarios';
    protected $primaryKey = "salas_usuarios_id";

    protected $fillable = [
        'status',
        'users_id',
        'salas_id'
    ];

    public function users()
    {
        return $this->belongsTo(Users::class);
    }

    public function salas()
    {
        return $this->belongsTo(Salas::class);
    }

    public function conversas()
    {
        return $this->hasMany(Conversas::class);
    }
}
