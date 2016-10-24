<?php 

namespace PET\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use PET\Http\Controllers\Controller;
use PET\Models\Empresas as Empresa;
use PET\Models\Users as User;
use PET\Models\Enderecos_animais as Endereco;
use PET\Models\Animais as Animal;
use PET\Models\Tipos as Tipo;
use PET\Models\Raca as raca;
use Crypt;


class Animais extends Controller{

	private $data;


	function __construct(Request $request,Redirector $redirect) {
	    

		$this->data = array();

		$this->data['titulo'] = 'Animais';

		$data = $request->session()->all();

		if ($request->session()->has('user') != 1) {

		     $redirect->to('/admin')->send();
			

		}


	}



	public function Listagem(){


		$this->data["animais"] = Animal::paginate(15);
		
		return view('Admin::animaislistagem',$this->data);



	}


	public function Novo(Request $request){


		$this->data["usuarios"] = User::all();

		$this->data['tipos'] = Tipo::all();

		
		return view('Admin::animaisnovo',$this->data);

	}


	public function Cadastro(Request $request){

		$newAnimal = new Animal();
		$newAnimal->nome = $request->nome;
		$newAnimal->sexo = $request->sexo;
		$newAnimal->raca = $request->raca;
		$newAnimal->tipos_id = $request->tipos_id;
		$newAnimal->users_id = $request->users_id;
		$newAnimal->mesma_raca = $request->mesma_raca;
		$newAnimal->distancia = $request->distancia;
		$newAnimal->porte = $request->porte;
		$newAnimal->descricao = $request->descricao;
		
		$destinationPath = 'uploads';
		$nome = $request->file('imagem')->getClientOriginalName(); 
		$request->file('imagem')->move($destinationPath,$nome);
		$newAnimal->imagem = $nome;

		$newAnimal->save();

		$newEndereco = new Endereco();
		$newEndereco->animais_id = $newAnimal->animais_id;
		$newEndereco->endereco = $request->endereco;
		$newEndereco->bairro = $request->bairro;
		$newEndereco->complemento = $request->complemento;
		$newEndereco->cidade = $request->cidade;
		$newEndereco->estado = $request->estado;
		$newEndereco->cep = $request->cep;
		$newEndereco->latitude = $request->latitude;
		$newEndereco->longitude = $request->longitude;
		$newEndereco->save();

		return redirect('/admin/animais');


	}


	public function Excluir($id){


		$usuario = Animal::find($id);

		$usuario->delete();
		
		return redirect('/admin/animais');



	}


	public function Editar($id){


		$animais  = Animal::find($id);

		$endereco = Endereco::where("animais_id",$animais->animais_id)->first();




		$this->data["usuarios"] = User::all();

		$this->data["animal"] = $animais;

		$this->data['tipos'] = Tipo::all();


		$this->data['racas'] = raca::where("tipos_id",$animais->tipos_id)->get();

		$this->data["endereco"] = $endereco;


		return view('Admin::animaiseditar',$this->data);

	}


	public function fazEdicao(Request $request){

		$newAnimal = Animal::find($request->animais_id);
		$newAnimal->nome =$request->nome;
		$newAnimal->sexo = $request->sexo;
		$newAnimal->raca = $request->raca;
		$newAnimal->tipos_id = $request->tipos_id;
		$newAnimal->users_id = $request->users_id;
		$newAnimal->mesma_raca = $request->mesma_raca;
		$newAnimal->porte = $request->porte;
		$newAnimal->descricao = $request->descricao;

		if ($request->hasFile('imagem')) {

			$destinationPath = 'uploads';
			$nome = $request->file('imagem')->getClientOriginalName(); 
			$request->file('imagem')->move($destinationPath,$nome);
			$newAnimal->imagem = $nome;

		}

		$newAnimal->save();

		$newEndereco = Endereco::where("animais_id",$newAnimal->animais_id)->first();
		$newEndereco->endereco = $request->endereco;
		$newEndereco->bairro = $request->bairro;
		$newEndereco->complemento = $request->complemento;
		$newEndereco->cidade = $request->cidade;
		$newEndereco->estado = $request->estado;
		$newEndereco->cep = $request->cep;
		$newEndereco->latitude = $request->latitude;
		$newEndereco->longitude = $request->longitude;
		$newEndereco->save();

		return redirect('/admin/animais');

	}



	


}