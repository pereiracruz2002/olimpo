<?php 

namespace PET\Modules\Admin\Controllers;



use Illuminate\Http\Request;

use Illuminate\Http\Response;

use Illuminate\Routing\Redirector;


use PET\Http\Controllers\Controller;

use PET\Models\Users as User;


use Crypt;


class Clientes extends Controller{

	private $data;


	function __construct(Request $request,Redirector $redirect) {
	    

		$this->data = array();

		$this->data['titulo'] = 'Clientes';


		$data = $request->session()->all();



		

		if ($request->session()->has('user') != 1) {

		     $redirect->to('/admin')->send();
			

		}



	}



	public function Listagem(){


		$this->data["usuarios"] = User::paginate(15);
		
		return view('Admin::clienteslistagem',$this->data);



	}


	public function Novo(Request $request){

		
		return view('Admin::clientesnovo',$this->data);

	}


	public function Cadastro(Request $request){

		$newUsuario = new User();

		$newUsuario->nome = $request->nome;

		$newUsuario->apelido = $request->apelido;

		$newUsuario->email = $request->email;

		$newUsuario->senha = Crypt::encrypt($request->senha);

		$newUsuario->cpf = $request->cpf;

		$newUsuario->latitude = $request->latitude;

		$newUsuario->longitude = $request->longitude;

		$newUsuario->perfis_id = 3;

		$newUsuario->endereco = $request->endereco;

		$newUsuario->bairro = $request->bairro;

		$newUsuario->complemento = $request->complemento;

		$newUsuario->cidade = $request->cidade;

		$newUsuario->estado = $request->estado;

		$newUsuario->cep = $request->cep;

		$destinationPath = 'uploads';

		$nome = $request->file('imagem')->getClientOriginalName(); 

		$request->file('imagem')->move($destinationPath,$nome);

		$newUsuario->imagem = $nome;


		$newUsuario->perfil = "usuario";


		$newUsuario->save();

		return redirect('/admin/clientes');


	}


	public function Excluir($id){


		$usuario = User::find($id);

		$usuario->delete();

		return redirect('/admin/clientes');



	}


	public function Editar($id){

		$this->data["usuario"] = User::find($id);

		$this->data["usuario"]->senha = Crypt::decrypt($this->data["usuario"]->senha);


		return view('Admin::clienteseditar',$this->data);

	}


	public function fazEdicao(Request $request){

		$usuario = User::find($request->users_id);

		$usuario->nome = $request->nome;

		$usuario->cpf = $request->cpf;

		$usuario->apelido = $request->apelido;

		$usuario->email = $request->email;

		$usuario->senha = Crypt::encrypt($request->senha);

		$usuario->latitude = $request->latitude;

		$usuario->longitude = $request->longitude;

		$usuario->cep = $request->cep;

		$usuario->endereco = $request->endereco;

		$usuario->bairro = $request->bairro;

		$usuario->estado = $request->estado;

		$usuario->complemento = $request->complemento;


		if ($request->hasFile('imagem')) {

			$destinationPath = 'uploads';

			$nome = $request->file('imagem')->getClientOriginalName(); 

			$request->file('imagem')->move($destinationPath,$nome);

			$newUsuario->imagem = $nome;
		   
		}


		$usuario->save();


		return redirect('/admin/clientes');





	}



	


}