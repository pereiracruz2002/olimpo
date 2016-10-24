@extends('Admin::master')

@section('title', 'Login Admin PetFans')


@section('content')
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main"> 
           

          <h2 class="sub-header">Clientes</h2>
          
          <a href="/admin/clientes/novo" class="btn btn-primary btn-lg">Novo</a>

          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>CPF</th>
                  <th>E-mail</th>
                  <th>Editar</th>
                  <th>Excluir</th>
                </tr>
              </thead>
              <tbody>

              @foreach ($usuarios as $user)

                <tr>
                  <td>{{$user->nome}}</td>
                  <td>{{$user->cpf}}</td>
                  <td>{{$user->email}}</td>
                  <td>
                    <button type="button" class="btn btn-default" aria-label="Left Align">
                      <a href="/admin/clientes/editar/{{$user->users_id}}">
                        <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span>
                      </a>
                    </button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-default" aria-label="Left Align">
                      <a href="/admin/clientes/excluir/{{$user->users_id}}">
                        <span class="glyphicon glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                      </a>
                    </button>
                  </td>

                  <!--
                  @if($user->perfil != 'usuario')
                  <td>
                    <button type="button" class="btn btn-default" aria-label="Left Align">
                      <a href="/admin/clientes/servicos/{{$user->users_id}}">
                        <span class="glyphicon glyphicon glyphicon-briefcase" aria-hidden="true"></span>
                      </a>
                    </button>
                  </td>
                  @else
                  <td></td>
                  @endif
                  -->
                </tr>

              @endforeach

               
              </tbody>
            </table>
          </div>

            {{ $usuarios->links() }}
    
        </div>
      </div>
    </div>
@endsection