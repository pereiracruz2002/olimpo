<?php

namespace PET\Http\Controllers;

use Illuminate\Http\Request;

use PET\Http\Requests;
use PET\Http\Controllers\Controller;
use PET\Models\Animais as Animal;
use PET\Models\Tipos as Tipo;
use PET\Models\Match as Match;
use PET\Models\Denunciar as Denunciar;
use PET\Models\Enderecos_animais as EnderecoAnimais;
use PET\Models\Enderecos as Enderecos;
use PET\Models\Salas_combinacoes as SalasCombinacoes;
use PET\Models\Conversas_combinacoes as ConversasAnimais;
use Crypt;
use Mail;
use DB;


class Animais extends Controller
{

    protected $latitude;
    protected $longitude;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($token)
    {



        $usuario = Crypt::decrypt($token);



        $listagem = Animal::where("users_id",$usuario)->get();

        foreach ($listagem as $item) {

            //print_r($item);
            $item->tipos;
            $item->users;
        }

        return $listagem;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo "create";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo "salvar";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($id){
        //
    }

    public function deletar($id,$token){

        $animal = Animal::find($id);

        $animal->delete();

        $animais = $this->index($token);

        $output = array("status"=>"sucesso","animais"=>$animais);

        return $output;

    }

    public function categorias(){

        return Tipo::select('tipos_id','nome')->orderby('nome', 'asc')->get();

    }


    public function upload(Request $request){

        $destinationPath = 'uploads'; // upload path
        //$extension = $request->file('arquivo')->getClientOriginalExtension(); // getting image extension
        $fileName = rand(11111,99999).'.jpg'; // renameing image
        $request->file('arquivo')->move($destinationPath, $fileName); // uploading file to given path
        // sending back with message

        print_r($fileName);



    }

    public function cadastrar(Request $request){

        $usuario = Crypt::decrypt($request->users_id);


        if(empty($request->imagem) && isset($request->imagem)){
            $imagem = 'default-animal.png';
        }else{
            $imagem = $request->imagem;
        }

        if ($request->hasFile('arquivo')){
            $destinationPath = 'uploads'; // upload path
            //$extension = $request->file('arquivo')->getClientOriginalExtension(); // getting image extension
            //$originalName = $request->file('arquivo')->getClientOriginalName();
            $fileName = rand(11111,99999).'.jpg'; // renameing image
            $request->file('arquivo')->move($destinationPath, $fileName); // uploading file to given path
            $imagem = $fileName;

        }



        $novoAnimal = new Animal(array(
            "nome"=> $request->nome,
            "tipos_id" => $request->tipos_id,
            "users_id" =>  $usuario,
            "sexo" => $request->sexo,
            "raca" => strtoupper($request->raca),
            "mesma_raca"  => $request->mesma_raca,
            "imagem" => $imagem,
            'distancia'=>$request->distancia,
            'porte' => $request->porte,
            'descricao' => $request->descricao
        ));

        $novoAnimal->save();
        $ultimoAnimal= $novoAnimal->animais_id;



        if(!empty($request->endereco)){
            $dadosEndereco = $request->endereco.' ,'.$request->bairro.' ,'.$request->cidade.','.$request->estado;
            $this->getCoordenada($dadosEndereco);

            $novoEnderecoAnimal = new EnderecoAnimais(array(
                    'animais_id'=> $ultimoAnimal,
                    'endereco'=>$request->endereco,
                    'bairro'=>$request->bairro,
                    'complemento'=>$request->complemento,
                    'cidade'=>$request->cidade,
                    'estado'=>$request->estado,
                    'cep'=>$request->cep,
                    'latitude'=>$this->latitude,
                    'longitude'=>$this->longitude,

                )
            );
        }else{
            $enderecoUsuario = Enderecos::find($usuario);

            $novoEnderecoAnimal = new EnderecoAnimais(array(
                    'animais_id'=> $ultimoAnimal,
                    'endereco'=>$enderecoUsuario->endereco,
                    'bairro'=>$enderecoUsuario->bairro,
                    'complemento'=>$enderecoUsuario->complemento,
                    'cidade'=>$enderecoUsuario->cidade,
                    'estado'=>$enderecoUsuario->estado,
                    'cep'=>$enderecoUsuario->cep,
                    'latitude'=>$enderecoUsuario->latitude,
                    'longitude'=>$enderecoUsuario->longitude,
                )
            );
        }



        $novoEnderecoAnimal->save();

        return array("status" => "sucesso");



    }

    public function editar(Request $request){


        $usuario = Crypt::decrypt($request->users_id);


        $busca = Animal::find($request->animais_id);

        $buscaEnd = EnderecoAnimais::where('animais_id',$request->animais_id)->get();


        $enderecos_animal_id = $buscaEnd[0]->enderecos_animal_id;


        $dados = array(
            "nome"=> $request->nome,
            "tipos_id" => $request->tipos_id,
            "sexo" => $request->sexo,
            "raca" => $request->raca,
            "mesma_raca"  => $request->mesma_raca,
            "distancia"=>$request->distancia,
            "users_id" =>  $usuario,
            'porte' => $request->porte,
            'descricao' => $request->descricao
        );

        if(!empty($request->endereco)){
            $dadosEndereco = $request->endereco.' ,'.$request->bairro.' ,'.$request->cidade.','.$request->estado;
            $this->getCoordenada($dadosEndereco);

            $novoEnderecoAnimal = array(
                "endereco"=> $request->endereco,
                "bairro" => $request->bairro,
                "complemento" => $request->complemento,
                "cidade" => $request->cidade,
                "estado"=>$request->estado,
                "cep" =>  $request->cep,
                'latitude'=>$this->latitude,
                'longitude'=>$this->longitude,
            );



        }else{
            $enderecoUsuario = Enderecos::find($usuario);

            $novoEnderecoAnimal = array(
                'endereco'=>$enderecoUsuario->endereco,
                'bairro'=>$enderecoUsuario->bairro,
                'complemento'=>$enderecoUsuario->complemento,
                'cidade'=>$enderecoUsuario->cidade,
                'estado'=>$enderecoUsuario->estado,
                'cep'=>$enderecoUsuario->cep,
                'latitude'=>$enderecoUsuario->latitude,
                'longitude'=>$enderecoUsuario->longitude,
            );
        }



        if(empty($request->imagem) && isset($request->imagem)){
            $imagem = NULL;
        }else{

            $dados["imagem"] = $request->imagem;
        }


        if ($request->hasFile('arquivo')){
            $destinationPath = 'uploads'; // upload path
            //$extension = $request->file('arquivo')->getClientOriginalExtension(); // getting image extension
            //$originalName = $request->file('arquivo')->getClientOriginalName();
            $fileName = rand(11111,99999).'.jpg'; // renameing image
            $request->file('arquivo')->move($destinationPath, $fileName); // uploading file to given path

            $dados["imagem"] = $fileName;

        }





        $busca->update($dados);

        EnderecoAnimais::find($enderecos_animal_id)->update($novoEnderecoAnimal);



        return array("status" => "sucesso");

    }

    public function getAnimal($id){
        $animal  = Animal::find($id);
        $animal->endereco;
        $animal->users;
        $animal->tipos;
        return $animal;

    }

    public function getParesAnimal(Request $request){

        $animal = Animal::find($request->animal);

        $animal->endereco;

        $animal->users;

        //$animal->users->enderecos;

        $inicia = $request->inicia;

        $quantidade = $request->quantidade;

    

        $rejeitados = json_decode($request->rejeitados);

        if(empty($rejeitados)){
             $rejeitados = [];


            $resultadoAnimais = $animal->buscaPars($animal,$rejeitados,$quantidade,$inicia);
        }else{

            $resultadoAnimais = $animal->buscaPars($animal,$rejeitados->rejeitados,$quantidade,$inicia);
        }




        //return $animal;
        return $resultadoAnimais;

    }


    public function getCoordenada($address){

        $address = str_replace(" ", "+", $address); // replace all the white space with "+" sign to match with google search pattern

        $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=$address";

        $response = file_get_contents($url);

        $json = json_decode($response,TRUE); //generate array object from the response from the web
        $this->latitude = $json['results'][0]['geometry']['location']['lat'];
        $this->longitude =$json['results'][0]['geometry']['location']['lng'];

    }


    public function salvaCombinacao(Request $request){

        $animal1 = $request->animal1;

        $animal2 = $request->animal2;


    $quantidade = count(Match::where([
    ['animal1',$animal1],
    ['animal2',$animal2],
    ])
    ->orWhere([
    ['animal1',$animal2],
    ['animal2',$animal1],
    ])
    ->get());

    if($quantidade == 0){


        $match = new Match;

        $match->animal1 = $animal1;
        $match->animal2 = $animal2;

        $match->save();


        $salas = new SalasCombinacoes;

        $salas->animal1 = $animal1;
        $salas->animal2 = $animal2;

        $salas->save();

        return array("status" => "sucesso","msg" => "cadastro efetuado com sucesso");

    }else{
        return array("status" => "sucesso","msg"=>"já cadastrado");
    }



    }


    public function listaCombinados($animais_id){
        $listagem = Match::where("animal1",$animais_id)
            ->orwhere("animal2",$animais_id)
            ->get();



        $listagem_combinados = array();


        foreach ($listagem as $item) {
            if($item->animal1==$animais_id){
                $animaisEncontrado = Animal::where("animais_id",$item->animal2)->get();
            }else{
                $animaisEncontrado = Animal::where("animais_id",$item->animal1)->get();
            }

            foreach($animaisEncontrado as $encontrado){
                $encontrado->users;
                $listagem_combinados[] =$encontrado;
            }




        }

        return $listagem_combinados;
    }



    public function descombinar(Request $request){

        $meuAnimal  = $request->meuAnimal;

        $animal = $request->animal;


        $resultado = Match::where("animal1",$meuAnimal)
        ->where("animal2",$animal)
        ->orWhere(function ($query) use($meuAnimal,$animal) {
                      $query->where('animal1', $animal)
                            ->where('animal2', $meuAnimal);
                  })
        ->get();


        foreach ($resultado as $item) {
            $item->delete();
        }

        $output = array("status" => "sucesso");

        return $output;
        

    }


    public function denunciar(Request $request){

        $denunciante = Crypt::decrypt($request->denuciante);

        $animais_id  = $request->animais_id;


        $denuncia = $request->denuncia;


        $novo = new Denunciar;

        $novo->animais_id = $animais_id;
        $novo->denunciante = $denunciante;
        $novo->denuncia= $denuncia;

        $novo->save();
    

        $data = array(
            'animal' => $animais_id,
            'denunciante' => $denunciante,
            'denuncia' => $denuncia
        );

        Mail::send('emails.email', $data, function ($message) {

            $message->to("erley@wvtodoz.com.br", "erley")->subject('Denuncia');
            
        });

        $output = array('status' => "sucesso");

        return $output;

    }

    public function conversas(Request $request){

        $conversas = ConversasAnimais::where("sala",$request->sala);


        if($request->inicio > 0){

            $conversas->skip($request->inicio);

        }else{
             $conversas->skip(0);
        }

        if($request->limit > 4){

            $conversas->take($request->limit);
        
        }else{
             $conversas->take(4);
        }

        $conversas->orderBy('conversas_combinacoes_id','desc');

        $quantidade = count(ConversasAnimais::where("sala",$request->sala)->get());


        $resultado = $conversas->get();

      
        foreach ($resultado as $conversa) {
            $conversa->animais;
            $conversa->animais->users;
        }


        $final  = array('conversas' => $resultado,'quantidade' => $quantidade );


           
        

        return $final;

    }


    public function conversasanteriores(Request $request){

        $conversas = ConversasAnimais::where("sala",$request->sala);


        if($request->inicio > 0){

            $conversas->skip($request->inicio);

        }else{
             $conversas->skip(0);
        }

        if($request->limit > 4){

            $conversas->take($request->limit);
        
        }else{
             $conversas->take(4);
        }

        $conversas->orderBy('conversas_combinacoes_id','desc');

        $quantidade = count(ConversasAnimais::where("sala",$request->sala)->get());


        $resultado = $conversas->get();

      
        foreach ($resultado as $conversa) {
            $conversa->animais;
            $conversa->animais->users;
        }


        $final  = array('conversas' => $resultado,'quantidade' => $quantidade );


           
        

        return $final;

    }


    public function getSalasAnimais(Request $request){

        $animal1 = $request->animal1;

        $animal2 = $request->animal2;

        $resultado = SalasCombinacoes::where("animal1",$animal1)
            ->where("animal2",$animal2)
            ->orWhere(function ($query) use($animal1,$animal2) {
                $query->where('animal1', $animal2)
                    ->where('animal2', $animal1);
            })
            ->get();

        return $resultado;
    }




}
