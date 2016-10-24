<!DOCTYPE html>
<!-- saved from url=(0049)http://v4-alpha.getbootstrap.com/examples/signin/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://v4-alpha.getbootstrap.com/favicon.ico">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/assets/dashboard/signin.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <form action="admin/fazlogin" class="form-signin" method="post">
      @if(Session::has('error'))
          <div style="text-align:center" class="alert alert-danger">
              <p>{{ Session::get('error') }}</p>
          </div>
      @endif
        <h2 class="form-signin-heading" style="text-align:center">PetFans Admin</h2>
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="text" name="email" id="inputEmail" class="form-control" placeholder="Digite seu email" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Senha</label>
        <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="Digite sua Senha" required="">
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Lembrar Senha
          </label>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      </form>

    </div> <!-- /container -->



  

</body></html>