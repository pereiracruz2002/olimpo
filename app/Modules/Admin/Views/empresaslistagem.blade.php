@extends('Admin::master')

@section('title', 'Login Admin PetFans')


@section('content')
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">        

          <h2 class="sub-header">Empresas</h2>
          
          <a href="/admin/empresas/novo" class="btn btn-primary btn-lg">Novo</a>

          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Nome Fantásia</th>
                  <th>CNPJ</th>
                  <th>E-mail</th>
                  <th>Editar</th>
                  <th>Excluir</th>
                  <th>Serviços</th>
                </tr>
              </thead>
              <tbody>

              @foreach ($usuarios as $user)

                <tr>
                  <td>{{$user->nome_fantasia}}</td>
                  <td>{{$user->cnpj}}</td>
                  <td>{{$user->email}}</td>
                  <td>
                    <button type="button" class="btn btn-default" aria-label="Left Align">
                      <a href="/admin/empresas/editar/{{$user->empresas_id}}">
                        <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span>
                      </a>
                    </button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-default" aria-label="Left Align">
                      <a href="/admin/empresas/excluir/{{$user->empresas_id}}">
                        <span class="glyphicon glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                      </a>
                    </button>
                  </td>
                  @if($user->perfil != 'usuario')
                  <td>
                    <button type="button" class="btn btn-default" aria-label="Left Align">
                      <a href="/admin/empresas/servicos/{{$user->empresas_id}}">
                        <span class="glyphicon glyphicon glyphicon-briefcase" aria-hidden="true"></span>
                      </a>
                    </button>
                  </td>
                  @else
                  <td></td>
                  @endif
                </tr>

              @endforeach

               
              </tbody>
            </table>
          </div>

             {{ $usuarios->links() }}
         <!--  <nav>
            <ul class="pagination">
              <li>
                <a href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li>
                <a href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav> -->
        </div>
      </div>
    </div>
@endsection