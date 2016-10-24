<?php

namespace PET\Http\Controllers;

use Illuminate\Http\Request;

use PET\Http\Requests;
use PET\Http\Controllers\Controller;
use PET\Models\Empresas as empresa;
use PET\Models\Enderecos as Enderecos;
use PET\Models\Users as user;
use Crypt;
use DB;

class Empresas extends Controller
{
    public function cadastraEmpresa(Request $request)
    {

        $novaEmpresa = new empresa(array(
            'users_id'=>Crypt::decrypt($request->users_id),
            'nome_fantasia'=>$request->nome_fantasia,
            'descricao' => $request->descricao,
            'email'=>$request->email,
            'cnpj' => $request->cnpj,
            'imagem'=>$request->imagem
        ));
        if($novaEmpresa->save()){
            $empresas_id= $novaEmpresa->empresas_id;
            $dadosEndereco = $request->endereco.' ,'.$request->bairro.' ,'.$request->cidade.','.$request->estado;
            $this->getCoordenada($dadosEndereco);

            $enderecoNovoPrestador = new Enderecos(array(
                'empresas_id'=>$empresas_id,
                'site'=>$request->site,
                'endereco'=>$request->endereco,
                'bairro'=>$request->bairro,
                'complemento'=>$request->complemento,
                'cidade'=>$request->cidade,
                'estado'=>$request->estado,
                'cep'=>$request->cep,
                'telefone'=>$request->telefone,
                'cnpj'=>$request->cnpj,
                'celular'=>$request->celular,
                'latitude'=>$this->latitude,
                'longitude'=>$this->longitude,
            ));

            if($enderecoNovoPrestador->save()){
                $perfil['perfis_id'] =3;
                user::find(Crypt::decrypt($request->users_id))->update($perfil);
                return  array('status' =>'sucesso','msg' => "Cadastro Efetuado com Sucesso");

            }else{
                return  array('status' =>'erro','msg' => "Não foi posssivel efetuar o cadastro");
            }


        }else{
            return  array('status' =>'erro','msg' => "Não foi posssivel efetuar o cadastro");
        }

    }




    public function getAllEmpresasOf(Request $request){

        $users_id=  Crypt::decrypt($request->token);

        $resultado = empresa::query();

        $resultado->where("users_id",$users_id);

        $valores = $resultado->get();

        foreach ($valores as $empresa) {

            $empresa->users;

            $empresa->servicos;

            $empresa->enderecos;
        }

        return $valores;
    }


    public function buscaDadosEmpresas($empresas_id)
    {

        $resultado = empresa::query();

        $resultado->where("empresas_id",$empresas_id);

        $valores = $resultado->get();

        foreach ($valores as $empresa) {

            $empresa->users;

            $empresa->servicos;

            $empresa->enderecos;
        }

        return $valores;
    }


    public function editarEmpresa(Request $request)
    {
        $empresas_id=  $request->empresas_id;

        $input['nome_fantasia'] = $request->nome_fantasia;
        $input['cnpj'] = $request->cnpj;
        $input['email'] = $request->email;
        $input['imagem'] = $request->imagem;
        $input['descricao'] = $request->descricao;
        $input['site'] = $request->site;

        $dadosEndereco = $request->endereco.' ,'.$request->bairro.' ,'.$request->cidade.','.$request->estado;
        $this->getCoordenada($dadosEndereco);

        if(empresa::find($request->empresas_id)->update($input)){

            $dados['endereco']=$request->endereco;
            $dados['bairro']=$request->bairro;
            $dados['complemento']=$request->complemento;
            $dados['cidade']=$request->cidade;
            $dados['estado']=$request->estado;
            $dados['cep']=$request->cep;
            $dados['telefone']=$request->telefone;
            $dados['cnpj']=$request->cnpj;
            $dados['celular']=$request->celular;
            $dados['latitude']=$this->latitude;
            $dados['longitude']=$this->longitude;

            if(Enderecos::find($empresas_id)->update($dados)){
              return ['status' => 'sucesso', 'msg' => 'sucesso'];
            }else{
                return ['status' => 'erro', 'msg' => 'Falha'];
            }

        }




    }


    public function excluirEmpresa(Request $request){

        $empresas = empresa::find($request->empresas_id);


        $empresas->delete();

        return $this->getAllEmpresasOf($request);
    }


    public function getCoordenada($address){

        $address = str_replace(" ", "+", $address); // replace all the white space with "+" sign to match with google search pattern

        $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=$address";

        $response = file_get_contents($url);

        $json = json_decode($response,TRUE); //generate array object from the response from the web
        $this->latitude = $json['results'][0]['geometry']['location']['lat'];
        $this->longitude =$json['results'][0]['geometry']['location']['lng'];


    }


    // public function hasServico(Request $post)
    // {
    //     $where = ['users_servicos.servicos_id' => $post->servicos_id];
    //     empresa::join('endereco', 'endereco.empresas_id', '=', 'empresas.empresas_id')
    //            ->('users_servicos', 'users_servicos.empresas_id', '=', 'empresas.empresas_id'); 

    // }


    public function getAllEmpresas()
    {
        return empresa::orderBy('nome_fantasia', 'desc')->get();
    }


     public function search(Request $request)
     {
         $search = $request->search;
         

         return empresa::where('nome_fantasia', 'LIKE', "%$search%")->get();
     }


}
