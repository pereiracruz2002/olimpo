<?php

namespace PET\Http\Controllers;

use Illuminate\Http\Request;

use PET\Http\Requests;
use PET\Http\Controllers\Controller;
use PET\Models\Doacoes as Doacao;
use PET\Models\Categoria_doacao as Cat_doacao;
use PET\Models\Doacao_interesse as DoacaoInteresse;
use PET\Models\Salas as Sala;
use PET\Models\Salas_usuarios as SalaUsuario;
use PET\Models\Doacao_interesse as interesses;

use PET\Http\Requests\DoacoesRequest;

use DB;

use Crypt;


class Doacoes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {




        $listagem = Doacao::all();


        foreach ($listagem as $item) {
            $item->tipos;
            $item->categoria_doacao;


        }

         return $listagem;

        
    }



    public function getminhasDoacoes(Request $request)
    {
        $users_id = Crypt::decrypt($request->users_id);

        $listagem = Doacao::where("users_id",$users_id)->get();


        foreach ($listagem as $item) {
            $item->tipos;
            $item->categoria_doacao;


        }

        return $listagem;


    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoacoesRequest $request)
    {

        $doacao = new Doacao();


        $doacao->titulo = $request->titulo;
        $doacao->descricao = $request->descricao;
        $doacao->tipo = $request->tipo;
        $doacao->categoria = $request->categoria;
        $doacao->status = $request->status;
        $doacao->users_id = Crypt::decrypt($request->users_id);

        if (isset($request->imagem) || !empty($request->imagem)){

            $doacao->imagem = $request->imagem;
          
        }

        $doacao->save();

        return array("status" => "sucesso" );


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doacao = Doacao::find($id);

        $doacao->tipos;
        $doacao->categoria_doacao;
        $doacao->users;

        return $doacao;

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DoacoesRequest $request, $id)
    {
        /*mandar no ajax um campo _method com valor PUT*/
         $doacao = Doacao::find($id);

         $doacao->titulo = $request->titulo;
         $doacao->descricao = $request->descricao;
         $doacao->tipo = $request->tipo;
         $doacao->categoria = $request->categoria;
         $doacao->status = $request->status;
         $doacao->users_id = Crypt::decrypt($request->users_id);

         if (isset($request->imagem) && !empty($request->imagem)){

             $doacao->imagem = $request->imagem;
           
         }

         $doacao->save();

         return array("status" => "sucesso" );
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doacao = Doacao::find($id);

        $doacao->delete($id);

        $listagem = Doacao::where("status","Ativo")->get();


        foreach ($listagem as $item) {
            $item->tipos;
            $item->categoria_doacao;


        }

         return $listagem;
    }


    public function alterarStatus(Request $request){

         $doacao = Doacao::find($request->id);

         $doacao->status = $request->status;

         $doacao->save();

         return array("status" => "sucesso");

    }


    public function upload(Request $request){

        $destinationPath = 'uploads'; // upload path
        //$extension = $request->file('arquivo')->getClientOriginalExtension(); // getting image extension
        $fileName = rand(11111,99999).'.jpg'; // renameing image
        $request->file('arquivo')->move($destinationPath, $fileName); // uploading file to given path
        // sending back with message

        print_r($fileName);

    }



      public function categorias_doacoes(){


        return Cat_doacao::all();

    }


    public function ListaItensDisponiveis(Request $request){



         $listagem = DB::table('doacoes');
             $listagem->select(DB::raw('doacoes.*,tipos.*,categoria_doacaos.*,users.users_id, users.nome, users.apelido, users.email, users.imagem,users.latitude,users.longitude,
                 (6371 * acos (cos ( radians('.$request->latitude.') )* cos( radians( users.latitude ) )* cos( radians( users.longitude ) - radians('.$request->longitude.') )+ sin ( radians('.$request->latitude.') ) * sin( radians( users.latitude ) ))) as distancia'));
             $listagem->join('users', 'doacoes.users_id', '=', 'users.users_id');
             $listagem->join('tipos', 'doacoes.tipo', '=', 'tipos.tipos_id');
             $listagem->join('categoria_doacaos', 'doacoes.categoria', '=', 'categoria_doacaos.categorias_doacao_id');
            
             
             


             if(isset($request->distancia) && !empty($request->distancia)){
                $listagem->having('distancia','<',$request->distancia);
             }else{
                $listagem->having('distancia','<','20');
             }

             if(isset($request->tipo) && !empty($request->tipo)){
                $listagem->where("doacoes.tipo",$request->tipo);
             }


             if(isset($request->categoria) && !empty($request->categoria)){
                $listagem->where("doacoes.categoria",$request->categoria);
             }

             $listagem->where("doacoes.users_id","!=",$request->users_id);

             $listagem->orderBy('distancia', 'desc');
             $resultado = $listagem->get();


             $filtro = array();


             foreach ($resultado as $doacao) {


                
                 $busca = DB::table('doacao_interesses');

                 $busca->where('users_id',$request->users_id);

                 $busca->where('doacoes_id',$doacao->doacoes_id);

                 $quantidade = count($busca->get());



                 if($quantidade == 0){
                    $filtro[] = $doacao;
                 }


             }


             return $filtro;

    }


    public function listaInteressandosDoacao(Request $request)
    {

        $listagem = DoacaoInteresse::where("doacoes_id", "=", $request->id)->get();

        foreach ($listagem as $item) {
            $item->doacoes->titulo;
            $item->users->nome;
            $item->users->imagem;

        }

        return $listagem;
    }




    public function criaSala(Request $request){

        $doacao_id = $request->doacao_id;
        
        $dono = $request->dono;

        $logado = Crypt::decrypt($request->token);


        $newSala = new Sala();

        $newSala->status = "Ativo";

        $newSala->tipo = "Doações";

        $newSala->save();


        $sala_id = $newSala->salas_id;


        $usuariosSala1 = new SalaUsuario();

        $usuariosSala1->users_id = $dono;

        $usuariosSala1->salas_id = $sala_id;

        $usuariosSala1->save(); 



        $usuariosSala2 = new SalaUsuario();

        $usuariosSala2->users_id = $logado;

        $usuariosSala2->salas_id = $sala_id;

        $usuariosSala2->save();


        $interesses = new interesses();

        $interesses->users_id = $logado;

        $interesses->doacoes_id = $doacao_id;

        $interesses->salas_id = $sala_id;

        $interesses->save();


        return  array('status' => 'sucesso',"sala"=>$sala_id,"logado"=>$logado);


    }

}
