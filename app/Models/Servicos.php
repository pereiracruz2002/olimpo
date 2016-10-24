<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;

class Servicos extends Model
{
	protected $table = 'servicos';
	protected $primaryKey = 'servicos_id';
	protected $fillable = array(
		'nome',
		'tipos_id'
		);

	public function tipos()
	{
		return $this->belongsTo(Tipos::class);
	}

    public function users() 
    {
        return $this->belongsToMany('PET\Models\Users');
    }
}
