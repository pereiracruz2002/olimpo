<?php 

namespace PET\Modules\Admin\Controllers;



use Illuminate\Http\Request;

use Illuminate\Http\Response;

use Illuminate\Routing\Redirector;


use PET\Http\Controllers\Controller;

use PET\Models\Empresas as Empresa;

use PET\Models\Users as User;

use PET\Models\Enderecos as Endereco;



use Crypt;


class Empresas extends Controller{

	private $data;


	function __construct(Request $request,Redirector $redirect) {
	    

		$this->data = array();

		$this->data['titulo'] = 'Empresas';


		$data = $request->session()->all();



		

		if ($request->session()->has('user') != 1) {

		     $redirect->to('/admin')->send();
			

		}



	}



	public function Listagem(){


		$this->data["usuarios"] = Empresa::paginate(15);
		
		return view('Admin::empresaslistagem',$this->data);



	}


	public function Novo(Request $request){


		$this->data["usuarios"] = User::all();

		
		return view('Admin::empresasnovo',$this->data);

	}


	public function Cadastro(Request $request){

		$newEmpresa = new Empresa();

		$newEmpresa->nome_fantasia = $request->nome_fantasia;

		$newEmpresa->cnpj = $request->cnpj;

		$newEmpresa->users_id = $request->users_id;

		$newEmpresa->email = $request->email;

		$newEmpresa->descricao = $request->descricao;

		$destinationPath = '../uploads';

		$nome = $request->file('imagem')->getClientOriginalName(); 

		$request->file('imagem')->move($destinationPath,$nome);

	

		$newEmpresa->imagem = $nome;

		$newEmpresa->save();


		$newEndereco = new Endereco();

		$newEndereco->empresas_id = $newEmpresa->empresas_id;

		$newEndereco->endereco = $request->endereco;

		$newEndereco->bairro = $request->bairro;

		$newEndereco->complemento = $request->complemento;

		$newEndereco->cidade = $request->cidade;

		$newEndereco->estado = $request->estado;

		$newEndereco->cep = $request->cep;

		$newEndereco->telefone = $request->telefone;

		$newEndereco->celular = $request->celular;

		$newEndereco->latitude = $request->latitude;

		$newEndereco->longitude = $request->longitude;

		$newEndereco->save();


		return redirect('/admin/empresas');


	}


	public function Excluir($id){


		$usuario = Empresa::find($id);

		$usuario->delete();
		
		return redirect('/admin/empresas');



	}


	public function Editar($id){


		$empresa  = Empresa::find($id);

		$endereco = Endereco::where("empresas_id",$empresa->empresas_id)->first();

		$this->data["usuarios"] = User::all();

		$this->data["empresa"] = $empresa;

		$this->data["endereco"] = $endereco;


		return view('Admin::empresaseditar',$this->data);

	}


	public function fazEdicao(Request $request){

		$newEmpresa = Empresa::find($request->empresas_id);

		$newEmpresa->cnpj =$request->cnpj;

		$newEmpresa->nome_fantasia = $request->nome_fantasia;

		$newEmpresa->users_id = $request->users_id;

		$newEmpresa->email = $request->email;

		$newEmpresa->descricao = $request->descricao;

	
		if ($request->hasFile('imagem')) {



			$destinationPath = public_path().'/uploads';

			$nome = $request->file('imagem')->getClientOriginalName(); 

			$request->file('imagem')->move($destinationPath,$nome);


			


	

			$newEmpresa->imagem = $nome;
		   
		}


		$newEmpresa->save();

		$newEndereco = Endereco::where("empresas_id",$newEmpresa->empresas_id)->first();

		$newEndereco->endereco = $request->endereco;

		$newEndereco->bairro = $request->bairro;

		$newEndereco->complemento = $request->complemento;

		$newEndereco->cidade = $request->cidade;

		$newEndereco->estado = $request->estado;

		$newEndereco->cep = $request->cep;

		$newEndereco->telefone = $request->telefone;

		$newEndereco->celular = $request->celular;

		$newEndereco->latitude = $request->latitude;

		$newEndereco->longitude = $request->longitude;

		$newEndereco->save();



		return redirect('/admin/empresas');





	}



	


}