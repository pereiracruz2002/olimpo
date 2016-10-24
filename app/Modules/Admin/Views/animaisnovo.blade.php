@extends('Admin::master')

@section('title', 'Login Admin PetFans')


@section('content')
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">        

          <form action="/admin/animais/cadastrar" method="POST" role="form" enctype="multipart/form-data">
            <legend>Novo Animal</legend>
          
            <div class="form-group">
              <label for="">Nome</label>
              <input type="text" class="form-control" name="nome" id="nome" required placeholder="Digite o Nome">
            </div>

            <div class="form-group">
              <label for="">Descrição</label>

              <textarea name="descricao" id="descricao" cols="30" rows="10" required class="form-control"></textarea>
              
            </div>


            <div class="form-group">
              <label for="">Gênero</label>

              <label class="radio-inline">
                <input type="radio" name="sexo" id="inlineRadio1" required value="macho"> Macho
              </label>

              <label class="radio-inline">
                <input type="radio" name="sexo" id="inlineRadio2" required value="femea"> Fêmea
              </label>

            </div>


            <div class="form-group">
              
              <label for="">Tipo</label>

              <select name="tipos_id" id="tipos_id" required class="form-control">
                <option value="">Selecione o tipo de animal</option>
                
                @foreach ($tipos as $tipo)
                    <option value="{{$tipo->tipos_id}}">{{$tipo->nome}}</option>
                @endforeach


              </select>

            </div>

            <div class="form-group">
              
              <label for="">Raça</label>

              <select name="raca" id="raca" required class="form-control">
                <option value="">Selecione a raça do animal</option>
                
               

              </select>

            </div>


            <div class="form-group">
              <label for="">Porte</label>
              <select name="porte" id="porte" required class="form-control">
                <option value="">Selecione o porte do animal</option>
                <option value="pequeno">Pequeno</option>
                <option value="medio">Médio</option>
                <option value="grande">Grande</option>
                
               

              </select>
            </div>



            <div class="form-group">
              <label for="">Mesma Raça</label>

              <label class="radio-inline">
                <input type="radio" name="mesma_raca" required id="mesma_raca" value="sim"> Sim
              </label>

              <label class="radio-inline">
                <input type="radio" name="mesma_raca" required id="mesma_raca" value="não"> Não
              </label>

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
              <label for="">Complemento</label>
              <input type="text" class="form-control" name="complemento" id="complemento" placeholder="Digite o Complemento">
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
              <label for="">Latitude</label>
              <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Digite a Latitude">
            </div>

            <div class="form-group">
              <label for="">Longitude</label>
              <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Digite a Longitude">
            </div>


            <div class="form-group">
              <label for="">Foto</label>
              <input type="file" class="form-control" required name="imagem" id="imagem">
            </div>



            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          
            <button type="submit" class="btn btn-primary">Cadastrar</button>
          </form>
          
         
        </div>

        <script>

        $(document).ready(function($) {
             $("#tipos_id").on("change",function(){

                var tipo = $(this).val();

                jQuery.ajax({
                  url: "/raca/retornaRaca/"+tipo+"/",
                  type: 'GET',
                  dataType: 'json',
                  complete: function(xhr, textStatus) {
                    //called when complete
                  },
                  success: function(data, textStatus, xhr) {


                      var html = "<option value=''>Selecione uma raça</option>";
                      
                      for (item in data) {

                        html += "<option value='"+data[item].nome+"'>"+data[item].nome+"</option>";

                      };

                      $("#raca").html(html);


                  },
                  error: function(xhr, textStatus, errorThrown) {
                    //called when there is an error
                  }
                });
                


             });
        });

        </script>
@endsection