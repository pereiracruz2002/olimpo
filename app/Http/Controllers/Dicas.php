<?php

namespace PET\Http\Controllers;

use Illuminate\Http\Request;

use PET\Http\Requests;
use PET\Http\Controllers\Controller;
use PET\Models\Dicas as Dicas_Model;
use Config;

class Dicas extends Controller
{
    public function doDia() 
    {

        $Url = Config::get('constants.WORDPRESS_URL');

        $dados = json_decode($this->curlExec($Url.'wp-json/wp/v2/posts?categories=9&order=desc&per_page=1'));
        $autor = json_decode($this->curlExec($Url."wp-json/wp/v2/users/".$dados[0]->author));
        $imagem = json_decode($this->curlExec($Url."wp-json/wp/v2/media/".$dados[0]->featured_media));



        $data = date('d/m/Y H:i:s',  strtotime($dados[0]->date));

 


        //return [];

        if(!empty($dados)){
        
        return ['author' => $autor->name, 
                'picture' => $imagem->media_details->sizes->thumbnail->source_url, 
                'data' => $data, 
                'text' => $dados[0]->excerpt->rendered, 
                'num_likes' => $dados[0]->likes,
                'link' => $dados[0]->link,
                'ID' =>$dados[0]->id 
                ];

        }else{
            return [];
        }
        
    }

    function curlExec($url, $post = NULL, array $header = array()){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if(count($header) > 0) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        if($post !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($ch);
        curl_close($ch);     
        return $data;
    }
}
