<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doacoes extends Model
{
	protected $table = 'doacoes';
	protected $primaryKey = 'doacoes_id';
	use SoftDeletes;
	protected $dates = ['deleted_at'];

	protected $fillable = array(
		'titulo',
		'descricao',
		'tipo',
		'categoria',
		'status',
		'users_id'
		);


	public function tipos()
	{
		return $this->belongsTo(Tipos::class,'tipo','tipos_id');
	}


	public function categoria_doacao()
	{
		return $this->belongsTo(Categoria_doacao::class,'categoria','categorias_doacao_id');
	}


	public function users()
	{
		return $this->belongsTo(Users::class);
	}

}
