<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;

class Users_Animais extends Model
{
    protected $table = 'users_animais';
    protected $primaryKey = "users_animais_id";
    protected $fillable = [
        'animais_id',
        'users_id'
    ];

    public function users(){

        return $this->hasOne(Users::class);
    }

    public function animais(){
        return $this->hasOne(Animais::class);

    }

}
