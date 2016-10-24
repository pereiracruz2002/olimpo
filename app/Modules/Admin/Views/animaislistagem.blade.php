@extends('Admin::master')

@section('title', 'Login Admin PetFans')


@section('content')
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">        

          <h2 class="sub-header">Animais</h2>
          
          <a href="/admin/animais/novo" class="btn btn-primary btn-lg">Novo</a>

          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Gênero</th>
                  <th>Raça</th>
                  <th>Editar</th>
                  <th>Excluir</th>
                 
                </tr>
              </thead>
              <tbody>

              @foreach ($animais as $animal)

                <tr>
                  <td>{{$animal->nome}}</td>
                  <td>{{$animal->sexo}}</td>
                  <td>{{$animal->raca}}</td>
                  <td>
                    <button type="button" class="btn btn-default" aria-label="Left Align">
                      <a href="/admin/animais/editar/{{$animal->animais_id}}">
                        <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span>
                      </a>
                    </button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-default" aria-label="Left Align">
                      <a href="/admin/animais/excluir/{{$animal->animais_id}}">
                        <span class="glyphicon glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                      </a>
                    </button>
                  </td>
                  
                </tr>

              @endforeach

               
              </tbody>
            </table>
          </div>

            {{ $animais->links() }}
    
        </div>
      </div>
    </div>
@endsection