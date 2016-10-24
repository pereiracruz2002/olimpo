<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;

class Reclamacoes extends Model
{
    protected $table = 'reclamacoes';
    protected $primaryKey = 'reclamacao_id';

    protected $fillable = array(
            'empresa',
            'empresas_id',
            'users_id',
            'assunto',
            'texto',
            'users_id',
            'site',
            'email'
            );
}

