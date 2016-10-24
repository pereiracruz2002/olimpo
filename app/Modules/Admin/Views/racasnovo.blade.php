@extends('Admin::master')

@section('title', 'Login Admin PetFans')


@section('content')
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">        

          <form action="/admin/racas/cadastrar" method="POST" role="form" enctype="multipart/form-data">
            <legend>Nova Raça</legend>
          
            <div class="form-group">
              <label for="">Nome da Raça</label>
              <input type="text" class="form-control" required name="nome" id="nome" placeholder="Digite o Nome Completo">
            </div>


            <div class="form-group">
              <label for="">Tipo de Animal</label>

              <select name="tipos_id" id="tipos_id" class="form-control">
                <option value="">Selecione o tipo de animal</option>
                @foreach($tipos as $tipo)
                  
                  <option value="{{$tipo->tipos_id}}">{{$tipo->nome}}</option>
                
                @endforeach
              </select>

            </div>




      


            <div class="form-group">
              <label for="">Foto</label>
              <input type="file" class="form-control" required name="imagem" id="imagem">
            </div>

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          
            <button type="submit" class="btn btn-primary">Cadastrar</button>
          </form>
          
         
        </div>
@endsection