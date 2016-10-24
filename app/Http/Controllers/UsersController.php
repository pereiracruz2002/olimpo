<?php

namespace PET\Http\Controllers;

use Illuminate\Http\Request;

use PET\Http\Requests;
use PET\Http\Controllers\Controller;

use PET\Http\Requests\UsersRequest;

use PET\Models\Animais as Animal;

use PET\Models\Users as User;

use Mail;


use Crypt;
use Facebook;
use Facebook\FacebookRequest;
use Facebook\FacebookRequestException;
use Facebook\GraphUser;
use Config;





class UsersController extends Controller
{
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
    public function create(UsersRequest $request)
    {


    }


    public function preCadastro(Request $request)
    {
        $novoCliente = new User(array(
            'nome' => $request->nome,
            'email' =>$request->email,
            'senha' => Crypt::encrypt($request->senha),
            'cpf' => $request->cpf,
            'perfis_id' => 3,
            'imagem' => 'default.png',
            'referencia' => $request->referencia
            ));

        if($novoCliente->save()){
            return  array('status' =>'sucesso','msg' => "Cadastro Efetuado com Sucesso");
        }else{
            return  array('status' =>'erro','msg' => "Não foi posssivel efetuar o cadastro");
        }
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
        $detalhes = User::find($id);
        return $detalhes;
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


    public function hasService($servicos_id, User $user, Request $request)

    {
        $latitude = $request->latitude;
        $longitude= $request->longitude;
        return $user->getMyServices($servicos_id,$latitude,$longitude);
    }

    public function getAllAnimalsOf($id){

        $listagem = Animal::where('users_id', $id)->get();
        
        foreach ($listagem as $item) {

            //print_r($item);
            $item->tipos;
        }

        return $listagem;

    }

    public function loginSimple(Request $request)
    {

        $username = $request->username;

        $password = $request->password;


        $verifica = User::query();


        $verifica->where("email",$username);


        $linhas = $verifica->count();

        $dados = $verifica->get();



        if($linhas > 0){


            foreach ($dados as $dado) {
                if($dado->senha){
                    $senhaDoBanco = Crypt::decrypt($dado->senha);
                    if($senhaDoBanco == $password){

                        $output = array(
                            'status' => "sucesso",
                            'token' => Crypt::encrypt($dado->users_id)
                        );

                    }else{
                        $output = array('status' => "error", 'msg' => 'Login ou Senha Incorretos' );
                    }
                } else {
                    $output = array('status' => "error", 'msg' => 'Você efetuou seu cadastro via Facebook, clique no botão "Entrar com Facebook" para logar.' );
                }
            }


        }else{
            $output = array('status' => "error", 'msg' => 'Login ou Senha Incorretos' );
        }


        return $output;
    }

    public function recuperarSenha(Request $request){

        $usuario = User::where('email', $request->email)->first();
        if($usuario){
            $senha = Crypt::decrypt($usuario->senha);
            Mail::send('emails.senha', ['senha' => $senha], function ($message) use ($usuario) {
                $message->to($usuario->email, $usuario->nome)->subject('Senha Recuperada');
            });
            return ['status' => 'ok', 'msg' => 'Por favor, acesse seu email para recuperar sua senha'];
        } else {
            return ['status' => 'erro', 'msg' => 'Usuário não encontrado'];
        }

    }

    public function fbLogin(Request $request, User $users) 
    {
        $fb = new Facebook\Facebook([
            'app_id' => Config::get('facebook.id'),
            'app_secret' => Config::get('facebook.secret'),
            'default_graph_version' => 'v2.3',
            'default_access_token' => $request->accessToken
        ]);

        try{
          $response = $fb->get('/me');
          $me= $response->getGraphUser();
          $save_usuario['fb_userid'] = $me->getId();
          $user = $users->where('fb_userid', $save_usuario['fb_userid'])->get()->first();
          $json['status'] = 'ok';
          if(!$user){
              $save_usuario['nome'] = $me->getName();
              $save_usuario['email'] = $me->getEmail();
              $save_usuario['imagem']  = "default.png";
              $users_id = $users->cadastrarUsuario($save_usuario);
              $json['token'] = Crypt::encrypt($users_id);
          } else {
              $json['token'] = Crypt::encrypt($user->users_id);
          }
          $json['status'] = 'ok';
          
        } catch(\Exception $ex){

            dd($ex->getMessage());
          //$json['status'] = 'erro';
          //$json['msg'] = 'Desculpe, não foi possivel efetuar o login com o Facebook';
        }
        return $json;
    }

    public function updatePosition(Request $request, User $user) 
    {
        $set = array('latitude' => $request->latitude, 'longitude' => $request->longitude);

        $user->updatePosition($set, Crypt::decrypt($request->token));
    }


    public function buscaUsuarioToken(Request $request){



        $users_id = Crypt::decrypt($request->token);



        $usuario = User::where('users_id', $users_id)->get();

      
        return $usuario;
    }


    public function editar(Request $request){

         $users_id = Crypt::decrypt($request->token);

         $usuario = User::find($users_id);

         $usuario->nome = $request->nome;

         $usuario->cpf = $request->cpf;

         $usuario->email = $request->email;

         $usuario->apelido = $request->apelido;

         $usuario->endereco = $request->endereco;

         $usuario->bairro = $request->bairro;

         $usuario->complemento = $request->complemento;

         $usuario->cidade = $request->cidade;

         $usuario->estado = $request->estado;

         $usuario->cep = $request->cep;

         if(!empty($request->imagem)){

          $usuario->imagem = $request->imagem;

         }

         $usuario->save();

         return array('status' => 'sucesso');


    }


    public function AtualizaDadosUsuario(Request $request){

        $usuario = Crypt::decrypt($request->token);

        $resultado = User::find($usuario);

        $resultado->player_id = $request->player_id;

        $resultado->token = $request->pushtoken;

        $resultado->save();

        return  array('status' => "Alterado com sucesso");

    }

    public function updatePerfil(Request $request)
    {
        $usuario = Crypt::decrypt($request->token);
        User::where('users_id', $usuario)->update(['perfil' => $request->perfil]);
        return  array('status' => "sucesso" , "perfil" => $request->perfil);
    }

}
