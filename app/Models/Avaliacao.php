<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
   	protected $table = 'avaliacao';
   	protected $primaryKey = "avalicao_id";
   	protected $fillable = [
   	    'like',
   	    'empresas_id',
   	    'users_id'
   	];
}
