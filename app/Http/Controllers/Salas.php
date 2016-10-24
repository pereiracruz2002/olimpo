<?php

namespace PET\Http\Controllers;

use Illuminate\Http\Request;

use PET\Http\Requests;
use PET\Http\Requests\ConversaRequest;
use PET\Http\Controllers\Controller;
use PET\Models\Salas as Sala;
use PET\Models\Salas_usuarios as SalasUsuarios;
use PET\Models\Conversas as conversas;
use DB;
use Crypt;

class Salas extends Controller
{
    public function getSalasUsers($salas_id, Request $request)
    {
        $user_id = Crypt::decrypt($request->token);
        $conversa = conversas::select('conversas.mensagem', 
                                      'conversas.created_at',
                                      'conversas.lida',
                                      DB::raw('IF(conversas.users_id = '.$user_id.', 1, 0) as me')
                                      )
                             ->join('users', 'users.users_id','=','conversas.users_id')
                             ->where(['conversas.salas_id' => $salas_id])->get();
        conversas::where(['conversas.salas_id' => $salas_id, 'lida' => 0])->where('users_id', '!=', $user_id)->update(['lida' => 1]);

        $participante = SalasUsuarios::select('users.nome', 'users.imagem')
                             ->join('users', 'users.users_id', '=', 'salas_usuarios.users_id')
                             ->where('salas_usuarios.salas_id', '=', $salas_id)
                             ->where('salas_usuarios.users_id', '!=', $user_id)
                             ->first();

        return ['conversa' => $conversa, 'participante' => $participante];
    }

    public function salvaMensagem(ConversaRequest $request)
    {

        $novaConversa = new conversas(array(
            'users_id'=>  Crypt::decrypt($request->users_id),
            'salas_id'=>$request->salas_id,
            'mensagem' => $request->mensagem,
        ));

        if($novaConversa->save()){
            $ultimaConversa= $novaConversa->conversas_id;
            $listagem = conversas::where("conversas_id", "=", $ultimaConversa)->get();
            foreach($listagem as $lista){
                $lista->users;
            }
            $output = array('status' => 'sucesso','conversas'=>$listagem);
            return $output;
        }

    }

    public function getConversas(Request $request){
        $users_id = Crypt::decrypt($request->user_id);

        $where['salas_usuarios.users_id'] = $users_id;
        if(isset($request->tipo)){
            $where['salas.tipo'] = $request->tipo;
        }
        $listagem = SalasUsuarios::select('users.nome', 
                                          'salas_usuarios.salas_id as sala_id',
                                          'salas_usuarios.users_id as me',
                                          'salas.tipo',
                                          DB::raw("IF(salas.tipo = 'serviços', 1, 2) as tipo_sala"),
                                          DB::raw('(SELECT COUNT(*) FROM conversas WHERE conversas.salas_id=sala_id AND lida = 0 AND users_id != '.$users_id.') as novas'),
                                          DB::raw('(SELECT users.users_id FROM users JOIN salas_usuarios ON salas_usuarios.users_id = users.users_id WHERE salas_usuarios.salas_id = sala_id AND salas_usuarios.users_id != me) as participante_id'),
                                          DB::raw('(SELECT nome FROM users WHERE users_id = participante_id) as participante'),
                                          DB::raw('(SELECT imagem FROM users WHERE users_id = participante_id) as participante_imagem'),
                                          DB::raw('(SELECT mensagem FROM conversas WHERE salas_id = sala_id ORDER BY conversas_id DESC  LIMIT 1) as ultima_msg')
                                         )
                                 ->join('users', 'users.users_id', '=', 'salas_usuarios.users_id')
                                 ->join('salas', 'salas.salas_id', '=', 'salas_usuarios.salas_id')
                                 ->where($where)
                                 ->get();
        return $listagem;
    }

    public function novaConversa(ConversaRequest $request){
        $novaSala = new sala(array(
            'status'=>'ativo',
        ));

        if($novaSala->save()){
            $ultimaSalaId= $novaSala->salas_id;
            $novaSalaUsuariosRemetente = new SalasUsuarios(array(
                    'users_id'=>Crypt::decrypt($request->users_id),
                    'salas_id'=>$ultimaSalaId,
                )
            );
            $novaSalaUsuariosRemetente->save();

            $novaSalaUsuariosReceptor = new SalasUsuarios(array(
                    'users_id'=>$request->users_id_conversa,
                    'salas_id'=>$ultimaSalaId,
                )
            );
            $novaSalaUsuariosReceptor->save();

            $novaConversa = new conversas(array(
                'users_id'=>  Crypt::decrypt($request->users_id),
                'salas_id'=>$ultimaSalaId,
                'mensagem' => $request->mensagem,

            ));

            if($novaConversa->save()){
                $output = array('status' => 'sucesso',"sala" =>  $ultimaSalaId);
                return $output;
            }
        }
    }
}
