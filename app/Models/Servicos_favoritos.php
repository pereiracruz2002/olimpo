<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;

class Servicos_favoritos extends Model
{
    	protected $table = 'servicos_favoritos';
    	protected $primaryKey = 'servicos_favoritos_id';
    	protected $fillable = array(
    		'users_id',
            'empresas_id'
    		);

    	public function users(){

    	    return $this->belongsTo(Users::class);
    	}

        public function empresas(){
            return $this->hasOne(Empresas::class,'empresas_id',"empresas_id");
        }

    	public function users_servicos(){

    	    return $this->belongsTo(Users_Servicos::class);
    	}

 
}
