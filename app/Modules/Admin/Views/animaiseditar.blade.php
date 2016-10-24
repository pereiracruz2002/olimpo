@extends('Admin::master')

@section('title', 'Login Admin PetFans')


@section('content')
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">        

          <form action="/admin/animais/editar" method="POST" role="form" enctype="multipart/form-data">
            <legend>Editar Animal</legend>
          
            <div class="form-group">
              <label for="">Nome</label>
              <input type="text" class="form-control"  name="nome" id="nome" value="{{$animal->nome}}" placeholder="Digite o Nome" required>
            </div>

            <div class="form-group">
              <label for="">Descrição</label>

              <textarea name="descricao" id="descricao" cols="30" rows="10" class="form-control" required>{{$animal->descricao}}</textarea>
              
            </div>


            <div class="form-group">
              <label for="">Gênero</label>

              <label class="radio-inline">
                <input type="radio" name="sexo" required {{ ($animal->sexo=='macho') ? 'checked' : '' }}  id="inlineRadio1" value="macho"> Macho
              </label>

              <label class="radio-inline">
                <input type="radio" name="sexo" required {{ ($animal->sexo=='femea') ? 'checked' : '' }} id="inlineRadio2" value="femea"> Fêmea
              </label>

            </div>


            <div class="form-group">
              
              <label for="">Tipo</label>

              <select name="tipos_id" id="tipos_id" class="form-control" required>
                <option value="">Selecione o tipo de animal</option>
                
                @foreach ($tipos as $tipo)
                    <option  value="{{$tipo->tipos_id}}" {{($animal->tipos_id==$tipo->tipos_id) ? 'selected' : '' }}>{{$tipo->nome}}</option>
                @endforeach


              </select>

            </div>

            <div class="form-group">
              
              <label for="">Raça</label>

              <select name="raca" id="raca" class="form-control" required>
                <option value="">Selecione a raça do animal</option>

                @foreach($racas as $raca)
                    
                  <option value="{{$raca->nome}}" {{($animal->racas_id==$tipo->racas_id) ? 'selected' : '' }}>{{$raca->nome}}</option>


                @endforeach
                
               

              </select>

            </div>


            <div class="form-group">
              <label for="">Porte</label>
              <select name="porte" id="porte" class="form-control" required>
                <option value="">Selecione o porte do animal</option>
                <option value="pequeno" {{($animal->porte == 'pequeno') ? 'selected' : '' }} >Pequeno</option>
                <option value="medio" {{($animal->porte == 'medio') ? 'selected' : '' }}>Médio</option>
                <option value="grande" {{($animal->porte == 'grande') ? 'selected' : '' }}>Grande</option>
              </select>
            </div>



            <div class="form-group">
              <label for="">Mesma Raça</label>

              <label class="radio-inline">
                <input type="radio" name="mesma_raca" id="mesma_raca" required value="sim" {{($animal->mesma_raca == 'sim') ? 'checked' : '' }} > Sim
              </label>

              <label class="radio-inline">
                <input type="radio" name="mesma_raca" id="mesma_raca" required value="não" {{($animal->mesma_raca == 'nao') ? 'checked' : '' }} > Não
              </label>

            </div>

 

            <div class="form-group">
              
              <label for="">Usuários</label>

              <select name="users_id" id="users_id" class="form-control" required>
                <option value="">Selecione o Usuario</option>
                
                @foreach ($usuarios as $user)
                    <option value="{{$user->users_id}}" {{($animal->users_id == $user->users_id) ? 'selected' : '' }} >{{$user->nome}}</option>
                @endforeach


              </select>

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
              <label for="">Complemento</label>
              <input type="text" class="form-control" name="complemento" id="complemento" value="{{$endereco->complemento}}" placeholder="Digite o Complemento">
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
              <label for="">Latitude</label>
              <input type="text" class="form-control" name="latitude" id="latitude" value="{{$endereco->latitude}}" placeholder="Digite a Latitude">
            </div>

            <div class="form-group">
              <label for="">Longitude</label>
              <input type="text" class="form-control"  name="longitude" id="longitude" value="{{$endereco->longitude}}" placeholder="Digite a Longitude">
            </div>

            <div class="form-group">
              <label for="">Foto</label>
              <input type="file" class="form-control" name="imagem" id="imagem">

              @if(!empty($animal->imagem) && $animal->imagem != null)


              <figure style="width:100px;margin-top:10px">
                <img src="/uploads/{{$animal->imagem}}" style="width:100%;" alt="">
              </figure>



              @endif
            </div>


            <input type="hidden" name="animais_id" value="{{$animal->animais_id}}">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          
            <button type="submit" class="btn btn-primary">Editar</button>
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

                        html += "<option value='"+data[item].racas_id+"'>"+data[item].nome+"</option>";

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