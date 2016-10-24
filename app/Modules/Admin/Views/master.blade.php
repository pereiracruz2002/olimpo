<html>
    <head>
        <title>@yield('title')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    

    <link rel="stylesheet" href="/assets/bootstrap/dist/css/bootstrap.min.css">

     <link href="/assets/dashboard/dashboard.css" rel="stylesheet">





    <script src="/assets/jquery/dist/jquery.min.js"></script>
    
    <script src="/assets/bootstrap/dist/js/bootstrap.min.js"></script>

    <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">PetFans Admin</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav navbar-right">

      
                <li><a href="/admin/logout">Sair</a></li>
              </ul>
     
            </div>
          </div>
        </nav>

        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
              <ul class="nav nav-sidebar">
                <li @if ($titulo == "Animais" ) class="active" @endif ><a href="/admin/animais">Animais <span class="sr-only">(current)</span></a></li>
                <li @if ($titulo == "Clientes" ) class="active" @endif ><a href="/admin/clientes">Clientes <span class="sr-only">(current)</span></a></li>
                <li @if ($titulo == "Empresas" ) class="active" @endif ><a href="/admin/empresas">Empresas <span class="sr-only">(current)</span></a></li>
                <li @if ($titulo == "Raças" ) class="active" @endif ><a href="/admin/racas">Raças <span class="sr-only">(current)</span></a></li>
               
              </ul>
             
            </div>
         
 
            @yield('content')


        </div>
    </body>
</html>