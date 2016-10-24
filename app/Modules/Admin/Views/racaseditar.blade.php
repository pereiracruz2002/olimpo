@extends('Admin::master')

@section('title', 'Login Admin PetFans')


@section('content')
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

        <form action="/admin/racas/editar" method="POST" role="form" enctype="multipart/form-data">
          <legend>Editar Raça</legend>
        
          <div class="form-group">
            <label for="">Nome da Raça</label>
            <input type="text" class="form-control" required name="nome" id="nome" value="{{$racas->nome}}" placeholder="Digite o Nome Completo">
          </div>


          <div class="form-group">
            <label for="">Tipo de Animal</label>

            <select name="tipos_id" id="tipos_id" class="form-control">
              <option value="">Selecione o tipo de animal</option>
              @foreach($tipos as $tipo)
                
                <option value="{{$tipo->tipos_id}}"  @if($racas->tipos_id == $tipo->tipos_id) selected @endif>{{$tipo->nome}}</option>
              
              @endforeach
            </select>

          </div>




        


          <div class="form-group">
            <label for="">Foto</label>
            <input type="file" class="form-control" name="imagem" id="imagem">
             @if(!empty($racas->imagem) && $racas->imagem != null)


              <figure style="width:100px;margin-top:10px">
                <img src="/uploads/{{$racas->imagem}}" style="width:100%;" alt="">
              </figure>



              @endif
          </div>

          <input type="hidden" name="racas_id" value="{{$racas->racas_id}}">

          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
          <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>   



          
         
        </div>
@endsection