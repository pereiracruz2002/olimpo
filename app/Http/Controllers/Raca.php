<?php

namespace PET\Http\Controllers;

use Illuminate\Http\Request;

use PET\Http\Requests;
use PET\Http\Controllers\Controller;
use PET\Models\Raca as Racas;
use DB;

class Raca extends Controller
{
    public function cadastrar(Request $request){

    	$novaRaca = new Racas(array(
    	    "nome"=> $request->nome,
    	    "tipos_id" => $request->tipos,
    	));

    	$novaRaca->save();

    }

	public function retornaRaca($id)
	{
		$racas = DB::table('racas');
		$racas->select(DB::raw('racas_id, racas.nome, IF(racas.imagem = "", "", CONCAT("https://app.petfans.com.br/uploads/", racas.imagem)) as img'));
		$racas->join('tipos', 'tipos.tipos_id', '=', 'racas.tipos_id');
        $racas->where('racas.tipos_id',$id)->orWhere('racas.nome',"OUTROS")
              ->orderBy('racas.nome', 'asc');
		$resultado = $racas->get();
		return $resultado;
	}
}
