<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;

class Perfis extends Model
{
  	protected $table = 'perfis';
  	protected $primaryKey = 'perfis_id';
  	protected $fillable = array(
  		'nome'
  		);


}
