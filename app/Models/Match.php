<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $table = 'matches';
    protected $primaryKey = 'matches_id';
    protected $fillable = array(
    	'animal1',
    	'animal2'
    	);

    public function animais()
    {
        return $this->hasOne(Animais::class);
    }

}
