<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;

class Salas_combinacoes extends Model
{
    protected $table = 'salas_combinacoes';
    protected $primaryKey = "salas_combinacoes_id";

    protected $fillable = [
        'animal1',
        'animal2',
    ];

    public function animais()
    {
        return $this->belongsTo(Animais::class);
    }
}
