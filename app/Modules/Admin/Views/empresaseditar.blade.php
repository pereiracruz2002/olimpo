@extends('Admin::master')

@section('title', 'Login Admin PetFans')


@section('content')
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">   



          <form action="/admin/empresas/editar" method="POST" role="form" enctype="multipart/form-data">
            <legend>Nova Empresa</legend>
          
            <div class="form-group">
              <label for="">Nome Fantásia</label>
              <input type="text" class="form-control" required name="nome_fantasia" id="nome_fantasia" value="{{$empresa->nome_fantasia}}" placeholder="Digite o Nome Completo">
            </div>


            <div class="form-group">
              <label for="">Descrição</label>



              <textarea name="descricao" id="descricao" required class="form-control" cols="30" rows="10" placeholder="Digite uma Descrição">{{$empresa->descricao}}</textarea>

            </div>

            <div class="form-group">
              <label for="">CNPJ</label>
              <input type="text" class="form-control" required name="cnpj" id="cnpj" placeholder="Digite o CNPJ" value="{{$empresa->cnpj}}">
            </div>

            <div class="form-group">
              
              <label for="">Usuários</label>

              <select name="users_id" required id="users_id" class="form-control">
                <option value="">Selecione o Usuario</option>
                
                @foreach ($usuarios as $user)

                    @if($user->users_id == $empresa->users_id)
                      <option value="{{$user->users_id}}" selected>{{$user->nome}}</option>
                    @else
                      <option value="{{$user->users_id}}">{{$user->nome}}</option>
                    @endif
                @endforeach


              </select>

            </div>


            <div class="form-group">
              <label for="">E-mail</label>
              <input type="text" class="form-control" required name="email" id="email" value="{{$empresa->email}}" placeholder="Digite o E-mail">
            </div>


            <div class="form-group">
              <label for="">CEP</label>
              <input type="text" class="form-control" required name="cep" id="cep" value="{{$endereco->cep}}" placeholder="Digite o CEP">
            </div>

            <div class="form-group">
              <label for="">Endereço</label>
              <input type="text" class="form-control" required name="endereco" id="endereco" value="{{$endereco->endereco}}" placeholder="Digite o Endereço">
            </div>

            <div class="form-group">
              <label for="">Bairro</label>
              <input type="text" class="form-control" required name="bairro" id="bairro" value="{{$endereco->bairro}}" placeholder="Digite o Bairro">
            </div>

            <div class="form-group">
              <label for="">Cidade</label>
              <input type="text" class="form-control" required name="cidade" id="cidade" value="{{$endereco->cidade}}" placeholder="Digite a Cidade">
            </div>

            <div class="form-group">
              <label for="">Estado</label>
              <input type="text" class="form-control" required name="estado" id="estado" value="{{$endereco->estado}}" placeholder="Digite o Estado">
            </div>


            <div class="form-group">
              <label for="">Complemento</label>
              <input type="text" class="form-control" name="complemento" id="complemento" value="{{$endereco->complemento}}" placeholder="Digite o Complemento">
            </div>


            <div class="form-group">
              <label for="">Latitude</label>
              <input type="text" class="form-control" name="latitude" id="latitude" value="{{$endereco->latitude}}" placeholder="Digite a latitude">
            </div>

            <div class="form-group">
              <label for="">Longitude</label>
              <input type="text" class="form-control" name="longitude" id=" longitude" value="{{$endereco->longitude}}" placeholder="Digite a longitude">
            </div>


            <div class="form-group">
              <label for="">Telefone</label>
              <input type="text" class="form-control" required name="telefone" id="telefone" value="{{$endereco->telefone}}" placeholder="Digite o Telefone">
            </div>

            <div class="form-group">
              <label for="">Celular</label>
              <input type="text" class="form-control" required name="celular" id="celular" value="{{$endereco->celular}}" placeholder="Digite o Celular">
            </div>



            <div class="form-group">
              <label for="">Foto</label>
              <input type="file" class="form-control" name="imagem" id="imagem">

              @if(!empty($empresa->imagem) && $empresa->imagem != null)


              <figure style="width:100px;margin-top:10px">
                <img src="/uploads/{{$empresa->imagem}}" style="width:100%;" alt="">
              </figure>



              @endif
              


            </div>

            <input type="hidden" name="empresas_id" id="empresas_id" value="{{$empresa->empresas_id}}">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          
            <button type="submit" class="btn btn-primary">Cadastrar</button>
          </form>
          
         
        </div>
@endsection