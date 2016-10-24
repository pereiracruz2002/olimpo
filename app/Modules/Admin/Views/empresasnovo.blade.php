@extends('Admin::master')

@section('title', 'Login Admin PetFans')


@section('content')
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">        

          <form action="/admin/empresas/cadastrar" method="POST" role="form" enctype="multipart/form-data">
            <legend>Nova Empresa</legend>
          
            <div class="form-group">
              <label for="">Nome Fantásia</label>
              <input type="text" class="form-control" required name="nome_fantasia" id="nome_fantasia" placeholder="Digite o Nome Completo">
            </div>


            <div class="form-group">
              <label for="">Descrição</label>

              <textarea name="descricao" id="descricao" required class="form-control" cols="30" rows="10" placeholder="Digite uma Descrição"></textarea>

            </div>

            <div class="form-group">
              <label for="">CNPJ</label>
              <input type="text" class="form-control" required name="cnpj" id="cnpj" placeholder="Digite o CNPJ">
            </div>

            <div class="form-group">
              
              <label for="">Usuários</label>

              <select name="users_id" id="users_id" required class="form-control">
                <option value="">Selecione o Usuario</option>
                
                @foreach ($usuarios as $user)
                    <option value="{{$user->users_id}}">{{$user->nome}}</option>
                @endforeach


              </select>

            </div>


            <div class="form-group">
              <label for="">E-mail</label>
              <input type="text" class="form-control" required name="email" id="email" placeholder="Digite o E-mail">
            </div>


            <div class="form-group">
              <label for="">CEP</label>
              <input type="text" class="form-control" required name="cep" id="cep" placeholder="Digite o CEP">
            </div>

            <div class="form-group">
              <label for="">Endereço</label>
              <input type="text" class="form-control" required name="endereco" id="endereco" placeholder="Digite o Endereço">
            </div>

            <div class="form-group">
              <label for="">Bairro</label>
              <input type="text" class="form-control" required name="bairro" id="bairro" placeholder="Digite o Bairro">
            </div>

            <div class="form-group">
              <label for="">Cidade</label>
              <input type="text" class="form-control" required name="cidade" id="cidade" placeholder="Digite a Cidade">
            </div>

            <div class="form-group">
              <label for="">Estado</label>
              <input type="text" class="form-control" required name="estado" id="estado" placeholder="Digite o Estado">
            </div>


            <div class="form-group">
              <label for="">Complemento</label>
              <input type="text" class="form-control" name="complemento" id="complemento" placeholder="Digite o Complemento">
            </div>


            <div class="form-group">
              <label for="">Latitude</label>
              <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Digite a latitude">
            </div>

            <div class="form-group">
              <label for="">Longitude</label>
              <input type="text" class="form-control" name="longitude" id=" longitude" placeholder="Digite a longitude">
            </div>


            <div class="form-group">
              <label for="">Telefone</label>
              <input type="text" class="form-control" required name="telefone" id="telefone" placeholder="Digite o Telefone">
            </div>

            <div class="form-group">
              <label for="">Celular</label>
              <input type="text" class="form-control" required name="celular" id="celular" placeholder="Digite o Celular">
            </div>



            <div class="form-group">
              <label for="">Logo</label>
              <input type="file" class="form-control" required name="imagem" id="imagem">
            </div>

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          
            <button type="submit" class="btn btn-primary">Cadastrar</button>
          </form>
          
         
        </div>
@endsection