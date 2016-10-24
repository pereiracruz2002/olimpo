<?php 

namespace PET\Modules\Admin\Controllers;



use Illuminate\Http\Request;

use Illuminate\Http\Response;

use Illuminate\Routing\Redirector;


use PET\Http\Controllers\Controller;

use PET\Models\Admin as Administrador;


use Crypt;


class Home extends Controller{


	private $data;


	function __construct(Request $request,Redirector $redirect) {
	    

		$this->data = array();

		$this->data['titulo'] = '';


		$data = $request->session()->all();



		

		if ($request->session()->has('user') != 1) {

		     $redirect->to('/admin')->send();
			

		}



	}



	public function Inicio(){



		
		return view('Admin::inicio',$this->data);



	}


	


}