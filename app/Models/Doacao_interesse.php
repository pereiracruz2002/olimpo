<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;

class Doacao_interesse extends Model
{
    protected $table = 'doacao_interesses';
    protected $primaryKey = 'doacao_interesses_id';


    protected $fillable = array(
        'users_id',
        'doacoes_id',
    );

    public function users()
    {
        return $this->belongsTo(Users::class);
    }

    public function doacoes()
    {
        return $this->belongsTo(Doacoes::class);
    }

}
