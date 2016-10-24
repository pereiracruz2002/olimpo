@extends('Admin::master')

@section('title', 'Login Admin PetFans')


@section('content')
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">        

          <form action="/admin/clientes/editar" method="POST" role="form" enctype="multipart/form-data">
            <legend>Editar Cliente</legend>
          
            <div class="form-group">
              <label for="">Nome</label>
              <input type="text" class="form-control" required name="nome" id="nome" value="{{$usuario->nome}}" placeholder="Digite o Nome Completo">
            </div>

            <div class="form-group">
              <label for="">CPF</label>
              <input type="text" class="form-control" required name="cpf" id="cpf" value="{{$usuario->cpf}}" placeholder="Digite o CPF">
            </div>

            <div class="form-group">
              <label for="">Apelido</label>
              <input type="text" class="form-control" name="apelido" id="apelido" value="{{$usuario->apelido}}" placeholder="Digite o Apelido">
            </div>

            <div class="form-group">
              <label for="">E-mail</label>
              <input type="text" class="form-control" required name="email" id="email" value="{{$usuario->email}}" placeholder="Digite o E-mail">
            </div>

            <div class="form-group">
              <label for="">Senha</label>
              <input type="password" class="form-control" required name="senha" id="senha" value="{{$usuario->senha}}" placeholder="Digite a senha">
            </div>

            <div class="form-group">
              <label for="">Latitude</label>
              <input type="text" class="form-control" name="latitude" id="latitude" value="{{$usuario->latitude}}" placeholder="Digite a latitude">
            </div>

            <div class="form-group">
              <label for="">Longitude</label>
              <input type="text" class="form-control" name="longitude" id=" longitude" value="{{$usuario->longitude}}" placeholder="Digite a longitude">
            </div>

            <div class="form-group">
              <label for="">CEP</label>
              <input type="text" class="form-control" required name="cep" id="cep" value="{{$usuario->cep}}" placeholder="Digite o CEP">
            </div>

            <div class="form-group">
              <label for="">Endereços</label>
              <input type="text" class="form-control" required name="endereco" value="{{$usuario->endereco}}" id="endereco" placeholder="Digite o Endereço">
            </div>

            <div class="form-group">
              <label for="">Bairro</label>
              <input type="text" class="form-control" required name="bairro" value="{{$usuario->bairro}}" id="bairro" placeholder="Digite o Bairro">
            </div>

            <div class="form-group">
              <label for="">Cidade</label>
              <input type="text" class="form-control" required name="cidade" value="{{$usuario->cidade}}" id="cidade" placeholder="Digite a Cidade">
            </div>

            <div class="form-group">
              <label for="">Estado</label>
              <input type="text" class="form-control" required name="estado" value="{{$usuario->estado}}" id="estado" placeholder="Digite o Estado">
            </div>


            <div class="form-group">
              <label for="">Complemento</label>
              <input type="text" class="form-control" name="complemento" value="{{$usuario->complemento}}" id="complemento" placeholder="Digite o Complemento">
            </div>

        <!--     <div class="form-group">
               <label for="">Perfil</label>
              
                <select name="perfil" id="perfil" class="form-control" required="required">
                  <option value="">Selecione o perfil</option>
                  <option value="usuario">Usuário</option>
                  <option value="empresa">Empresa</option>
                </select>
             
            </div> -->

            <input type="hidden" name="perfil" id="perfil" value="usuario">

            <div class="form-group">
              <label for="">Foto</label>
              <input type="file" class="form-control" name="imagem" id="imagem">

              @if(!empty($usuario->imagem) && $usuario->imagem != null)


              <figure style="width:100px;margin-top:10px">
                <img src="/uploads/{{$usuario->imagem}}" style="width:100%;" alt="">
              </figure>



              @endif
              


            </div>

            <input type="hidden" name="users_id" id="users_id" value="{{$usuario->users_id}}">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          
            <button type="submit" class="btn btn-primary">Editar</button>
          </form>
          
         
        </div>
@endsection