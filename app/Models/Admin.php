<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';
    protected $primaryKey = 'id';

    protected $fillable = array(
            'login',
            'senha'
            );
}
