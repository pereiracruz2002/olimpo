<?php 

namespace PET\Modules\Admin\Controllers;



use Illuminate\Http\Request;

use Illuminate\Http\Response;


use PET\Http\Controllers\Controller;

use PET\Models\Admin as Administrador;


use Crypt;


class Login extends Controller{


	public function login(){



		
		return view('Admin::login');



	}


	public function fazlogin(Request $request){


		$login = $request->email;

		$senha = $request->senha;

		$resultado = Administrador::where("login",$login)->first();

		

		if(count($resultado) > 0){

			$senhaDoBanco = Crypt::decrypt($resultado->senha);

			if($senha == $senhaDoBanco){

				$request->session()->put('user', $resultado);

				return redirect('/admin/inicio');

				

			}else{

				$request->session()->flash('error', 'Senha Incorreta');
				return redirect('/admin');

			}

		}else{
			$request->session()->flash('error', 'Login Invalido');

			return redirect('/admin');
		}




	}

	public function fazLogout(Request $request){

		$request->session()->flush();

		return redirect('/admin');		

	}





}