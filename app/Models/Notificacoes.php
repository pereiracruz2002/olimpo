<?php

namespace PET\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacoes extends Model
{
    protected $table = 'notificacoes';
    protected $primaryKey = 'notificacao_id';
    protected $fillable = array(
    	'mensagem',
    	'users_id',
    	'extras',
    	'tipo',
    	'url',
    	'visto'
    	);

    public function users()
    {
        return $this->belongsTo(Users::class);
    }

    public function sendMessage($fields)
    {
	  $fields = json_encode($fields);
	  
	  $ch = curl_init();
	  curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
	  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
	                         'Authorization: Basic N2RiYzg5MGUtMDdjMy00OWE1LWI4ZTQtZDlkYmUzOTYwMDMz'));
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	  curl_setopt($ch, CURLOPT_HEADER, FALSE);
	  curl_setopt($ch, CURLOPT_POST, TRUE);
	  curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

	  $response = curl_exec($ch);
	  curl_close($ch);
      die(print '<pre>'.print_r($response, true)."</pre>");
	  
	  // return $response;

	}

}
