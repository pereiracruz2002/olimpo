<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;

class Denunciar extends Model
{
    protected $table = 'denunciar';
    protected $primaryKey = 'id';

    protected $fillable = array(
        'animais_id',
        'denunciante',
        'denuncia'
    );
}
