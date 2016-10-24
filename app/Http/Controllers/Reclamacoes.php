<?php

namespace PET\Http\Controllers;

use Illuminate\Http\Request;

use PET\Http\Requests;
use PET\Http\Controllers\Controller;
use PET\Models\Reclamacoes as Reclamacoes_Model;
use PET\Models\Notificacoes as Notificacao;
use Crypt;
use DB;
use Mail;

class Reclamacoes extends Controller
{
    public function nova(Request $request) 
    {
        $reclamacao_data = array(
            'users_id' => Crypt::decrypt($request->token),
            'empresa' => $request->empresa,
            'site' => $request->site,
            'assunto' => $request->assunto,
            'texto' => $request->texto
            );
        if($request->empresas_id){
            $reclamacao_data['empresas_id'] = $request->empresas_id;
            $user = DB::table('empresas')
                      ->select('users.users_id', 'users.email', 'users.nome', 'users.player_id', 'empresas.cnpj')
                      ->join('users', 'users.users_id','=', 'empresas.users_id')
                      ->where('empresas.empresas_id', $request->empresas_id)
                      ->first();
            $reclamacao_data['responsavel'] = $user->nome;
            $reclamacao_data['email'] = $user->email;
            $reclamacao_data['cnpj'] = $user->cnpj;
            $send_to = $user->email;


        } else {
            $whois_data = $this->whois_data($request->site);
            $reclamacao_data['cnpj'] = $whois_data['ownerid'];
            if(is_array($whois_data['e-mail'])){
                $send_to = $whois_data['e-mail'];
                $reclamacao_data['email'] = implode($whois_data['e-mail'], ',');
            } else {
                $send_to = $whois_data['e-mail'];
                $reclamacao_data['email'] = $whois_data['e-mail'];
                $reclamacao_data['responsavel'] = $whois_data['person'];
            }
        }
        
        $reclamacao = new Reclamacoes_Model($reclamacao_data);
        $reclamacao->save();
        $reclamacao_id = $reclamacao->reclamacao_id;

        $denunciante = DB::table('users')->where('users_id', $reclamacao_data['users_id'])->first();
        $reclamacao_data['denunciante'] = $denunciante->nome;
        $reclamacao_data['reclamacao_id'] = base64_encode(Crypt::encrypt($reclamacao_id));

        Mail::send('emails.reclamacao_nova', $reclamacao_data, function ($message) use ($send_to, $reclamacao_data) {
            $message->to($send_to)->subject('Uma reclamação da '.$reclamacao_data['empresa'].' foi feita');
        });

        if(isset($user)){
 		    $newNotificacao = new Notificacao();
			$newNotificacao->users_id = $user->users_id;
			$newNotificacao->mensagem = 'Uma reclamação da '.$reclamacao_data['empresa'] .' foi feita';
			$newNotificacao->url = "/app/reclamacao/detalhes/".$reclamacao_id;
            $newNotificacao->visto = "não";
            $newNotificacao->save();
		    $quantidadeNotificacoes = count(Notificacao::where("users_id",$user->users_id)->where("visto","não")->get());

            
            $content = array(
              "en" => $newNotificacao->mensagem
            );
            
            $fields = array(
              'app_id' => "18277e6e-afc4-4936-ab8b-0fd31cb80a30",
              'include_player_ids' => array($user->player_id),
              'data' => array(
           		  "quantidadeNotificacoes" => $quantidadeNotificacoes,
                  'tipo' => "reclamacao",
                  "site" => $newNotificacao->url,
                  'notificacao' => $newNotificacao->notificacao_id
              ),
              'contents' => $content
            );
            $newNotificacao->sendMessage($fields);
        }

        return ['status' => 'sucesso', 'id' => $reclamacao_id];
    }

    private function whois_data($full_domain) 
    {
        if(filter_var($full_domain, FILTER_VALIDATE_URL)){
            $domain = preg_replace('/http(s?):\/\//', '', $full_domain);
            $whois = shell_exec('whois '.$domain);
            preg_match_all('/(.+):( +)(.+)/', $whois, $data_parse);

            $data = array();
            foreach ($data_parse[1] as $key => $key_val) {
                if(isset($data[$key_val])){
                    if(is_array($data[$key_val])){
                        $data[$key_val][] = $data_parse[3][$key];
                    } else {
                        $data[$key_val] = array($data[$key_val], $data_parse[3][$key]);
                    }
                } else {
                    $data[$key_val] = utf8_encode($data_parse[3][$key]);
                }

            }
            return $data;
        }

    }
}
