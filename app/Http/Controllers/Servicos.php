<?php

namespace PET\Http\Controllers;

use Illuminate\Http\Request;

use PET\Models\Comentarios_servicos as Comentarios ;
use PET\Models\Respostas_comentarios as Respostas;
use PET\Http\Requests;
use PET\Http\Controllers\Controller;
use PET\Models\Servicos as Servico;
use PET\Models\Users_Servicos as User_Servico;
use PET\Models\Servicos_favoritos as Servico_favorito;
use PET\Models\Avaliacao as Avalia;
use PET\Models\Empresas as Empresa;
use Crypt;
use DB;

class Servicos extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $listagem = Servico::all();
        foreach ($listagem as $item) {
            $item->tipos;
            //print_r($servico);
        }

        return $listagem;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $servico = User_Servico::find($id);

        $servico->users;

        $servico->servicos;

        $servico->enderecos;

        $servico->qtdGostei = count(Avalia::where('like','=','sim')
            ->where("users_servicos_id",$id)->get()) ;

        $servico->qtdNaoGostei = count(Avalia::where('like','=','não')
            ->where("users_servicos_id",$id)->get()); 



        return $servico;

    }

    public function busca($post,$id){

        $id_user = Crypt::decrypt($id);

        $empresa = Empresa::find($post);

        $empresa->enderecos;

        $empresa->users;

        $empresa->Users_Servicos;

        foreach ($empresa->Users_Servicos as $item) {
            $item->servicos;
        }

        $totalfavoritos = count(Servico_favorito::where("empresas_id",$post)->where("users_id",$id_user)->get());

         if($totalfavoritos > 0){

            $empresa->favorito = "sim";

        }else{
            $empresa->favorito = "não";
        }

        $empresa->qtdGostei = count(Avalia::where('like','=','sim')
            ->where("empresas_id",$post)->get()) ;

        $empresa->qtdNaoGostei = count(Avalia::where('like','=','não')
            ->where("empresas_id",$post)->get()); 


        $curtida = count(Avalia::where("users_id",$id_user)->where("empresas_id",$post)->get());

        if($curtida > 0){

            $resultado = Avalia::where("users_id",$id_user)->where("empresas_id",$post)->first(); 

    
            $empresa->curtida = $resultado->like;

        }
        

        return $empresa;



    }


    public function buscaEmpresaSite(Request $request){


        $empresa = Empresa::find($request->empresa);

        $empresa->enderecos;

        $empresa->Users_Servicos;

        foreach ($empresa->Users_Servicos as $item) {
            $item->servicos;
        }


        $empresa->qtdGostei = count(Avalia::where('like','=','sim')
            ->where("empresas_id",$empresa)->get()) ;

        $empresa->qtdNaoGostei = count(Avalia::where('like','=','não')
            ->where("empresas_id",$empresa)->get()); 


        return $empresa;



    }

    // public function busca($post,$id){


  
    //     $servico = User_Servico::where('empresas_id',$post)->first();




    //     $id_user = Crypt::decrypt($id);



    //     $servico->token=$id_user;

    //     $servico->users;
    //     $servico->servicos;

    //     $servico->enderecos;

    //     $servico->empresas;

    //     $servico->servicos_favoritos;

    //     $totalfavoritos = count(Servico_favorito::where("users_servicos_id",$post)->where("users_id",$id)->get());

    //     if($totalfavoritos > 0){

    //         $servico->favorito = "sim";

    //     }else{
    //         $servico->favorito = "não";
    //     }

    //     $servico->qtdGostei = count(Avalia::where('like','=','sim')
    //         ->where("users_servicos_id",$post)->get()) ;

    //     $servico->qtdNaoGostei = count(Avalia::where('like','=','não')
    //         ->where("users_servicos_id",$post)->get()); 


    //     $curtida = count(Avalia::where("users_id",$id)->get());

    //     if($curtida > 0){

    //         $resultado = Avalia::where("users_id",$id)->get();


    //         $servico->curtida = $resultado[0]->like;

    //     }else{

    //         $servico->curtida = "não";
    //     }

    //     return $servico;

    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAllServicosOf($id){

        $listagem = Servico::select('nome', 'tipos_id', 'servicos_id')->where('tipos_id', $id)->orderby('nome', 'asc')->get();

        foreach ($listagem as $item) {

            //print_r($item);
            $item->tipos;
        }

        return $listagem;

    }

    public function buscaServicosSite(Request $request){



        $listagemPrestadores = User_Servico::join("servicos","users_servicos.servicos_id","=","servicos.servicos_id")
        ->where(array('servicos.tipos_id' => $request->animal ,"servicos.nome" => $request->servico))->get();


        foreach ($listagemPrestadores as $prestador) {
            
           

            $prestador->servicos;

            $prestador->enderecos;

            $prestador->empresas;
        }



        return $listagemPrestadores;




    }

    public function avaliacao(Request $request){
        $users_servicos_id = $request->user_servicos_id;
        $users_id=  Crypt::decrypt($request->users_id);

        $valor = $request->valor;



        $verifica = Avalia::query();

        $resultado = Avalia::where("users_id","=",$users_id)->where("empresas_id","=",$users_servicos_id)->get();

        $linhas = $resultado->count();

        $servico = User_Servico::find($request);
            if($linhas > 0){

            foreach ($resultado as $item) {
                $avaliacao_id = $item->avalicao_id;
                $likeAtualBanco = $item->like;
            }

       

            $dados['like'] = $valor;
            $dados['empresas_id'] = $users_servicos_id;
            $dados['users_id'] = $users_id;

            Avalia::find($avaliacao_id)->update($dados);


            $qtdGostei = count(Avalia::where('like','=','sim')
            ->where("empresas_id",$users_servicos_id)->get()) ;

            $qtdNaoGostei = count(Avalia::where('like','=','não')
            ->where("empresas_id",$users_servicos_id)->get());

                return ['like' => $valor,'qtdGostei'=>$qtdGostei,'qtdNaoGostei'=>$qtdNaoGostei];
        }else{
            $novaAvaliacao = new Avalia(array(
                'empresas_id'=>$users_servicos_id,
                'users_id'=>$users_id,
                'like'=>$valor,
            ));
            $novaAvaliacao->save();

            $qtdGostei = count(Avalia::where('like','=','sim')
                ->where("empresas_id",$users_servicos_id)->get()) ;

            $qtdNaoGostei = count(Avalia::where('like','=','não')
                ->where("empresas_id",$users_servicos_id)->get());

            return ['like' => $valor,'qtdGostei'=>$qtdGostei,'qtdNaoGostei'=>$qtdNaoGostei];
        }

    }


    public function meusServicos(Request $request){

        //$users_id=  Crypt::decrypt($request->token);

        $empresas_id = $request->empresas_id;

        $resultado = User_Servico::query();

        $resultado->where("empresas_id",$empresas_id);

        $valores = $resultado->get();




        foreach ($valores as $servico) {

            $servico->users;

            $servico->servicos;

            $servico->enderecos;

            $servico->empresas;
        }

        return $valores;
    }

    public function excluirMeuServico(Request $request){

    
        //$users_id=  Crypt::decrypt($request->token);


        $servico = User_Servico::find($request->servico);

        $servico->delete();


        return $this->meusServicos($request);


    }

    public function comentariosSobrePrestador(Request $request){

        $servico_id = $request->servico;

        $resultado = Comentarios::where("empresas_id",$servico_id)
            ->get();


        foreach($resultado as $item){
            $item->users;

           $item->respostas;

            foreach($item->respostas as $resposta){
                $resposta->users;
            }
        }

        return $resultado;


    }

    public function cadastraComentariosSobrePrestador(Request $request){

        $users_id=  Crypt::decrypt($request->token);



        $novoComentario = new Comentarios(array(
            "comentario"=>$request->comentario,
            "users_id"=> $users_id,
            "empresas_id"=> $request->servico
        ));

        $novoComentario->save();

        $comentarios = $this->comentariosSobrePrestador($request);

        $output = array("status"=>"sucesso","comentarios" =>$comentarios);

        return $output;


    }

    public function cadastraRespostaSobrePrestador(Request $request){

        $users_id=  Crypt::decrypt($request->token);

    
        $novaResposta = new Respostas(array(
           "comentario" => $request->resposta,
            "comentarios_servicos_id"=> $request->comentarios_servicos_id,
            "users_id"=> $users_id
        ));

        $novaResposta->save();

        $comentarios = $this->comentariosSobrePrestador($request);

        $output = array("status"=>"sucesso","comentarios" =>$comentarios);

        return $output;

    }

    public function alteraFavorito(Request $request){

        $users_servicos_id = $request->users_servicos_id;
        $users_id = Crypt::decrypt($request->users_id);

        $resultado = Servico_favorito::where("users_id",$users_id)->where("empresas_id",$users_servicos_id);

        $linhas = $resultado->count();

        if($linhas > 0){

            $linha = $resultado;

            $linha->delete(); 

            $status = "não";

        }else{

            $novoFavorito = new Servico_favorito();

            $novoFavorito->empresas_id =$users_servicos_id;
            $novoFavorito->users_id =$users_id;

            $novoFavorito->save();



            $status = "sim";
        }


        return array('status' => 'sucesso' , 'statusfavorito' => $status);
        



    }


    public function listaFavoritos(Request $request){

        $users_id = Crypt::decrypt($request->users_id);

        $resultado = Servico_favorito::where("users_id",$users_id)->get();

        foreach ($resultado as $favorito) {
            $favorito->users;
            $favorito->empresas;
            //$favorito->empresas->servicos;
    

        }
        return $resultado;
    }

    public function buscar(Request $request)
    {
        $buscaServicos = User_Servico::join('enderecos','users_servicos.enderecos_id','=','enderecos.enderecos_id')
                                     ->join('servicos','users_servicos.servicos_id','=','servicos.servicos_id')
                                     ->join('empresas',"users_servicos.empresas_id","=","empresas.empresas_id");

        if(!empty($request->latitude)){
            $buscaServicos->select('users_servicos.empresas_id', 'empresas.nome_fantasia', 'servicos.nome', DB::raw('(6371 * acos (cos ( radians('.$request->latitude.') )* cos( radians(enderecos.latitude ) )* cos( radians( enderecos.longitude ) - radians('.$request->longitude.') )+ sin ( radians('.$request->latitude.') ) * sin( radians( enderecos.latitude ) ))) as localizacao'));

            $buscaServicos->having('localizacao', '<', $request->distancia);
        } else {
            $buscaServicos->select('users_servicos.empresas_id', 'empresas.nome_fantasia', 'servicos.nome', 'enderecos.bairro')
                          ->join('cepbr_endereco', DB::raw("replace(enderecos.cep, '-','')"), '=', 'cepbr_endereco.cep')
                          ->join('cepbr_bairro', 'cepbr_endereco.id_bairro', '=', 'cepbr_bairro.id_bairro')
                          ->where('cepbr_endereco.cep', str_replace('-','', $request->cep));
        }
        if($request->categoria){
            $buscaServicos->where('users_servicos.servicos_id', $request->categoria);
        } else {
            $buscaServicos->where('servicos.tipos_id', $request->tipo);
        }

        return array('status' =>'sucesso' ,'dados'=>$buscaServicos->get());
    }
}
