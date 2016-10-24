<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <meta http-equiv="Content-Security-Policy"/>
    
    <title></title>

    <script>
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    window.fbAsyncInit = function() {
    FB.init({
      appId      : '171596476233449',
      cookie     : true,  // enable cookies to allow the server to access 
                          // the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v2.5' // use graph api version 2.5
    });
    }



    </script>

    <script src="https://app.petfans.com.br/njs/socket.io/socket.io.js"></script>

    <link rel="stylesheet" href="css/ArialRoundedMTBold/styles.css">

    <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>


    <link href="css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">

    
    <script src="assets/jquery/dist/jquery.min.js"></script>
    
    <script src="assets/bootstrap/dist/js/bootstrap.min.js"></script>
    

    <script src="assets/angular/angular.min.js"></script>

    <script src="assets/angular-route/angular-route.min.js"></script>
    
 

    <!-- your app's js -->
    <script src="js/app.js"></script>
    <script src="modulos/diretivas/navbar.js"></script>
    <script src="modulos/diretivas/rodape.js"></script>
    <script src="modulos/inicio/service/login.js"></script>
    <script src="modulos/inicio/controllers/controllers.js"></script>
    <script src="modulos/animais/services/animais.js"></script>
    <script src="modulos/servicos/services/servicos.js"></script>
    <script src="modulos/usuarios/services/usuarios.js"></script>
    <script src="modulos/animais/controllers/controllers.js"></script>
    <script src="modulos/servicos/controllers/controllers.js"></script>
    <script src="modulos/usuarios/controllers/controllers.js"></script>
    <script src="modulos/usuarios/services/usuarios.js"></script>


  </head>
  <body ng-app="starter">
    <div id="fb-root"></div>
    <div ng-view></div>
   
  </body>

</html>
