<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;

class Salas extends Model
{
    protected $table = 'salas';
    protected $primaryKey = 'salas_id';
    protected $fillable = array(
        'status'
    );

    public function salas_usuarios(){
        return $this->hasMany(Salas_usuarios::class);
    }

    public function conversas(){
        return $this->hasMany(Conversas::class);
    }

    public function users(){
        return $this->belongsToMany(Users::class,'salas_usuarios','users_id','users_id');
    }
}
