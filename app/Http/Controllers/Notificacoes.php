<?php

namespace PET\Http\Controllers;

use Illuminate\Http\Request;

use PET\Http\Requests;
use PET\Http\Controllers\Controller;
use PET\Models\Notificacoes as Notificacao;
use PET\Models\Animais as Animal;
use PET\Models\Users as User;
use Crypt;

class Notificacoes extends Controller
{

	public function sendMessage($content,$fields){

	  $fields = json_encode($fields);

	  
	  $ch = curl_init();
	  curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
	  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
	                         'Authorization: Basic N2RiYzg5MGUtMDdjMy00OWE1LWI4ZTQtZDlkYmUzOTYwMDMz'));
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	  curl_setopt($ch, CURLOPT_HEADER, FALSE);
	  curl_setopt($ch, CURLOPT_POST, TRUE);
	  curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

	  $response = curl_exec($ch);
	  curl_close($ch);
	  
	  // return $response;

	}

	public function listagem(Request $request){

		$users_id = Crypt::decrypt($request->token);

		$notificacoes = Notificacao::where("users_id",$users_id)
		->skip($request->inicio)
		->take($request->quantidade)
		->orderBy('notificacao_id', 'desc')
		->get();

		$quantidadeNotificacoes = count(Notificacao::where("users_id",$users_id)->where("visto","não")->get());

		foreach ($notificacoes as $notificao) {
			$notificao->users;
		}



		return array('status' => 'sucesso' , 'quantidade' => $quantidadeNotificacoes,'notificacoes'=>$notificacoes);

	}
	
	public function conversas(Request $request){

		$logado = Crypt::decrypt($request->logado);




		$sala = $request->sala;




		$newNotificacao = new Notificacao();



		if(isset($request->extras) && !empty($request->extras)){

			$newNotificacao->extras = $request->extras;
		
		}

		$newNotificacao->tipo = $request->tipo;

		if($request->tipo == "doações"){



			$user2 = $request->user2;

			$newNotificacao->users_id = $user2;

			$dadosUsuarioPush = User::find($user2);

			$dadosUsuario = User::find($logado);

			$newNotificacao->mensagem = "O usuario ". $dadosUsuario->nome." envio uma nova mensagem sobre a doação";

			$newNotificacao->url = "/app/conversas/detalhes/".$logado."/".$sala."/2";

		}

		if($request->tipo == "conversa"){

			$user2 = $request->user2;

			$newNotificacao->users_id = $user2;

			$dadosUsuarioPush = User::find($user2);

			$dadosUsuario = User::find($logado);

			$newNotificacao->mensagem = "O usuario ". $dadosUsuario->nome." te enviou uma mensagem";

			$newNotificacao->url = "/app/conversas/detalhes/".$logado."/".$sala."/1";

		}

		if($request->tipo == "conversa_combinações"){

			if(empty($request->animal) || !isset($request->animal)){
				return  array('error' => "passe o animal" );
			}else{



				$meuanimal = $request->meu;


				$animal = Animal::find($request->animal);

				$user2 = $animal->users_id;

				$newNotificacao->users_id = $user2;

				$dadosUsuarioPush = User::find($user2);

				$newNotificacao->mensagem = "O ".$animal->nome." tem uma nova mensagem";



				$newNotificacao->url = "/app/encontros/detalhes_matches/".$meuanimal."/".$animal->animais_id;

			}


		}

		$newNotificacao->visto = "não";

		$newNotificacao->save();

		$quantidadeNotificacoes = count(Notificacao::where("users_id",$user2)->where("visto","não")->get());

		$content = array(
		  "en" => $newNotificacao->mensagem
		  );
		
		$fields = array(
		  'app_id' => "18277e6e-afc4-4936-ab8b-0fd31cb80a30",
		  'include_player_ids' => array($dadosUsuarioPush->player_id),
		  'data' => array(
		  	"quantidadeNotificacoes" => $quantidadeNotificacoes,
		  	'tipo' => "mensagem",
		  	"site" => $newNotificacao->url,
		  	'notificacao' => $newNotificacao->notificacao_id
		  	),
		  'contents' => $content
		);
		
		$this->sendMessage($content,$fields);

		//$return["allresponses"] = $response;
		//$return = json_encode( $return);
		/* 
		print("\n\nJSON received:\n");
		print($return);
		print("\n");
		*/

		return  array('output' => "notificação salva com sucesso",
			"quantidade" => $quantidadeNotificacoes
			);
	
	}


	public function notificacaoCombinacao(Request $request){


		$meuAnimal = $request->meu;

		$dadosMeuAnimal = Animal::find($request->meu);

		$AnimalCombinado = $request->combinacao;

		$dadosCombinado = Animal::find($AnimalCombinado);

		$userCombinado = $dadosCombinado->users_id;

		$dadosUsuarioPush = User::find($userCombinado);

		$newNotificacao = new Notificacao();

		if(isset($request->extras) && !empty($request->extras)){

			$newNotificacao->extras = $request->extras;
		
		}

		$newNotificacao->tipo = $request->tipo;

		$newNotificacao->url = "/app/encontros/matches/".$request->combinacao;

		$newNotificacao->users_id = $userCombinado;

		$newNotificacao->mensagem = "Nova combinação para ".$dadosCombinado->nome;

		$imagem = $dadosMeuAnimal->imagem;

		$mensagemPopup = "Nova combinação para ".$dadosCombinado->nome.", deseja ver agora?";

		$newNotificacao->visto = "não";

		$newNotificacao->save();

		$quantidadeNotificacoes = count(Notificacao::where("users_id",$userCombinado)->where("visto","não")->get());
	
		$content = array(
		  "en" => $newNotificacao->mensagem
		  );
		
		$fields = array(
		  'app_id' => "18277e6e-afc4-4936-ab8b-0fd31cb80a30",
		  'include_player_ids' => array($dadosUsuarioPush->player_id),
		  'data' => array(
		  	"quantidadeNotificacoes" => $quantidadeNotificacoes,
		  	'tipo' => "combinação",
		  	"site" => $newNotificacao->url,
		  	'notificacao' => $newNotificacao->notificacao_id,
		  	'mensagemPopup' => $mensagemPopup,
		  	'imagem' => $imagem
		  	),
		  'contents' => $content
		);
		
		$this->sendMessage($content,$fields);

		return  array('output' => "notificação salva com sucesso",
			"quantidade" => $quantidadeNotificacoes
			);
	
	}
    
	public function alteraStatus(Request $request){

		$users_id = Crypt::decrypt($request->token);

		$Notificacao = Notificacao::find($request->id);

		$Notificacao->visto = "sim";

		$Notificacao->save();

		$quantidadeNotificacoes = count(Notificacao::where("users_id",$users_id)->where("visto","não")->get());


		return array('status' =>"sucesso" ,"quantidade"=>$quantidadeNotificacoes);



	}


	public function alteraStatusPorUrl(Request $request){

		$users_id = Crypt::decrypt($request->token);

		$Notificacoes = Notificacao::where("url",$request->url)->get();


		foreach ($Notificacoes as $Notificacao) {
			

			$Notificacao->visto = "sim";

			$Notificacao->save();


		}

		
		$quantidadeNotificacoes = count(Notificacao::where("users_id",$users_id)->where("visto","não")->get());


		return array('status' =>"sucesso" ,"quantidade"=>$quantidadeNotificacoes);



	}





}
