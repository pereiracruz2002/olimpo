<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;

class Tipos extends Model
{
    protected $table = 'tipos';
    protected $primaryKey = 'tipos_id';
    protected $fillable = array(
    	'nome'
    	);
    
}
