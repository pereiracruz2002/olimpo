<?php 

namespace PET\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use PET\Http\Controllers\Controller;
use PET\Models\Users as User;
use PET\Models\Raca as Raca;
use PET\Models\Tipos as Tipo;
use Crypt;

class Racas extends Controller{

	private $data;


	function __construct(Request $request,Redirector $redirect) {
	    
		$this->data = array();
		$this->data['titulo'] = 'Raças';
		$data = $request->session()->all();

		if ($request->session()->has('user') != 1) {
		     $redirect->to('/admin')->send();
		}

	}



	public function Listagem(){


		$this->data["usuarios"] = Raca::paginate(15);


		
		return view('Admin::racaslistagem',$this->data);



	}


	public function Novo(Request $request){

		$this->data['tipos'] = Tipo::all();


		
		return view('Admin::racasnovo',$this->data);

	}


	public function Cadastro(Request $request){

		$newRaca = new Raca();
		$newRaca->nome = $request->nome;
		$newRaca->tipos_id = $request->tipos_id;
        if($request->hasFile('imagem')){
		    $destinationPath = 'uploads';
		    $nome = md5(uniqid(rand(), true)).'.'.$request->file('imagem')->getClientOriginalExtension(); 
		    $request->file('imagem')->move($destinationPath,$nome);
            $newRaca->imagem = $nome;
        }
        $newRaca->save();
		return redirect('/admin/racas');
	}


	public function Excluir($id){


		$usuario = Raca::find($id);

		$usuario->delete();

		return redirect('/admin/racas');



	}


	public function Editar($id){

		$this->data["racas"] = Raca::find($id);

		$this->data['tipos'] = Tipo::all();

		return view('Admin::racaseditar',$this->data);

	}


	public function fazEdicao(Request $request){

		$raca = Raca::find($request->racas_id);

		$raca->nome = $request->nome;

		$raca->tipos_id = $request->tipos_id;

		if ($request->hasFile('imagem')) {

			$destinationPath = 'uploads';

		    $nome = md5(uniqid(rand(), true)).'.'.$request->file('imagem')->getClientOriginalExtension(); 

			$request->file('imagem')->move($destinationPath,$nome);

			$raca->imagem = $nome;
		   
		}


		$raca->save();


		return redirect('/admin/racas/editar/'.$request->racas_id);





	}



	


}
