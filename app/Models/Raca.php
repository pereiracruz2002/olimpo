<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;

class Raca extends Model
{
    protected $table = 'racas';
    protected $primaryKey = 'racas_id';
    protected $fillable = array(
    	'nome',
    	'tipos_id'
    	);
}
