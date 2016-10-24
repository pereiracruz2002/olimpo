<?php

namespace PET\Http\Controllers;

use Illuminate\Http\Request;

use PET\Http\Requests;
use PET\Http\Controllers\Controller;
use PET\Models\Users_Servicos as User_Servico;
use PET\Models\Enderecos as Enderecos;
use PET\Models\Users as user;
use PET\Models\Empresas as empresas;
use PET\Http\Requests\UserServicesRequest;
use Crypt;

class UsersServicos extends Controller
{

    protected $latitude;
    protected $longitude;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(UserServicesRequest $request)
    {
        //$dadosEndereco = $request->endereco.' ,'.$request->bairro.' ,'.$request->cidade.','.$request->estado;


        //$this->getCoordenada($dadosEndereco);
//        $enderecoNovoPrestador = new Enderecos(array(
//            'users_id'=>Crypt::decrypt($request->users_id),
//            'endereco'=>$request->endereco,
//            'bairro'=>$request->bairro,
//            'complemento'=>$request->complemento,
//            'cidade'=>$request->cidade,
//            'estado'=>$request->estado,
//            'cep'=>$request->cep,
//            'telefone'=>$request->telefone,
//            'cnpj'=>$request->cnpj,
//            'celular'=>$request->celular,
//            'latitude'=>$this->latitude,
//            'longitude'=>$this->longitude,
//        ));
        //if($enderecoNovoPrestador->save()){

           $enderecoEmpresa = empresas::find($request->empresas_id);
           $end = $enderecoEmpresa->enderecos;



            $novoPrestador = new User_Servico(array(
                //'users_id'=>Crypt::decrypt($request->users_id),
                'servicos_id'=>$request->servicos_id,
                'empresas_id'=> $request->empresas_id,
                'descricao'=>$request->descricao,
                'enderecos_id'=>$end->enderecos_id
            ));
//            if($novoPrestador->save()){
//
//                $perfil['perfis_id'] =3;
//                user::find(Crypt::decrypt($request->users_id))->update($perfil);
//                return  array('status' =>'sucesso','msg' => "Cadastro Efetuado com Sucesso");
//
//            }else{
//
//                return  array('status' =>'erro','msg' => "Não foi posssivel efetuar o cadastro");
//            }
        if($novoPrestador->save()){
            return  array('status' =>'sucesso','msg' => "Cadastro Efetuado com Sucesso");
        }else{
            return  array('status' =>'erro','msg' => "Não foi posssivel efetuar o cadastro");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

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
    public function update(UserServicesRequest $request)
    {


    }

    public function editar(Request $request)
    {
        $users_id = Crypt::decrypt($request->users_id);
       // $dadosEndereco = $request->endereco.' ,'.$request->bairro.' ,'.$request->cidade.','.$request->estado;
       // $this->getCoordenada($dadosEndereco);
        //$input = $request->all();
        $input['users_servicos_id'] = $request->users_servicos_id;
        //$input['cnpj'] = $request->cnpj;
        $input['descricao'] = $request->descricao;
        $input['servicos_id'] = $request->servicos_id;
        $input['tipos_id'] = $request->tipos_id;



        if(User_Servico::find($request->user_servico_id)->update($input)){

//            $dados['endereco']=$request->endereco;
//            $dados['bairro']=$request->bairro;
//            $dados['complemento']=$request->complemento;
//            $dados['cidade']=$request->cidade;
//            $dados['estado']=$request->estado;
//            $dados['cep']=$request->cep;
//            $dados['telefone']=$request->telefone;
//            $dados['cnpj']=$request->cnpj;
//            $dados['celular']=$request->celular;
//            $dados['latitude']=$this->latitude;
//            $dados['longitude']=$this->longitude;
            return ['status' => 'sucesso', 'msg' => 'sucesso'];

//            if(Enderecos::find($users_id)->update($dados)){
//                return ['status' => 'sucesso', 'msg' => 'sucesso'];
//            }

        }else{
            return ['status' => 'erro', 'msg' => 'Falha'];
        };

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

    public function getCoordenada($address){

        $address = str_replace(" ", "+", $address); // replace all the white space with "+" sign to match with google search pattern

        $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=$address";

        $response = file_get_contents($url);

        $json = json_decode($response,TRUE); //generate array object from the response from the web
        $this->latitude = $json['results'][0]['geometry']['location']['lat'];
        $this->longitude =$json['results'][0]['geometry']['location']['lng'];

        //return ($json['results'][0]['geometry']['location']['lat'].",".$json['results'][0]['geometry']['location']['lng']);
    }
}
