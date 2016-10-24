// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'



pet = angular.module('starter',['ngRoute']);

pet.constant('URL_SOCKET', 'https://app.petfans.com.br/njs/');

pet.constant('URL_API', 'https://app.petfans.com.br/');

    pet.config(function($routeProvider, $locationProvider) {


   $routeProvider.when('/', {
      templateUrl : 'modulos/inicio/views/inicio.html',
      controller     : 'InicioCtrl',
       cache: false
    });

   $routeProvider.when('/animais/', {
      templateUrl : 'modulos/animais/views/listagem.html',
      controller  : 'AnimaisCtrl',
       cache: false
    });

   $routeProvider.when('/meus-animais/', {
      templateUrl : 'modulos/animais/views/listagem-meus-animais.html',
      controller  : 'MeusAnimaisCtrl',
       cache: false
    });

   $routeProvider.when('/meus-animais/novo/', {
      templateUrl : 'modulos/animais/views/novo-meus-animais.html',
      controller  : 'MeusAnimaisNovoCtrl',
       cache: false
    });

   $routeProvider.when('/meus-animais/editar/:id', {
      templateUrl : 'modulos/animais/views/editar-meus-animais.html',
      controller  : 'MeusAnimaisEditarCtrl',
       cache: false
    });
  

   $routeProvider.when('/servicos/:id', {
       templateUrl:'modulos/servicos/views/listagem.html',
       controller: 'ServicosCtrl',
       cache:false
   });

    $routeProvider.when('/usuarios/servico/:servico_id', {
       templateUrl:'modulos/usuarios/views/listagem.html',
       controller: 'UsuariosServicoCtrl',
       cache:false
   });
   

   $routeProvider.when('/usuarios/detalhe/:usuario_id', {
       templateUrl:'modulos/usuarios/views/detalhes.html',
       controller: 'UsuariosServicoDetalhesCtrl',
       cache:false
   });


   $routeProvider.when('/cadastro/', {
      templateUrl : 'modulos/usuarios/views/cadastro.html',
      controller     : 'CadastroServicoCtrl',
       cache: false
    });

   $routeProvider.when('/forgot-password/', {
      templateUrl: 'modulos/usuarios/views/lembrete.html',
      controller: 'LembreteCtrl',
       cache: false
    });

   $routeProvider.when('/meus-servicos/listagem/', {
      templateUrl: 'modulos/usuarios/views/listagem-meus-sevicos.html',
      controller: 'ListagemMeusServicosCtrl',
       cache: false
    });

   $routeProvider.when('/meus-servicos/novo/', {
      templateUrl: 'modulos/usuarios/views/novo-meus-servicos.html',
      controller: 'NovoMeusServicosCtrl',
       cache: false
    });

   $routeProvider.when('/meus-servicos/editar/:id', {
      templateUrl: 'modulos/usuarios/views/editar-meus-servicos.html',
      controller: 'EditarMeusServicosCtrl',
       cache: false
    });

    $routeProvider.when('/usuarios/mensagens/:id', {
        cache:false,
        templateUrl:'modulos/usuarios/views/usuario_mensagens.html',
        controller: 'UsuarioMensagensCtrl'
    });

    $routeProvider.when('/conversas/detalhes/:id/:id_conversa', {
        cache:false,
        templateUrl:'modulos/usuarios/views/usuario_mensagens_detalhes.html',
        controller: 'UsuarioMensagensDetalhesCtrl'
    });


    $routeProvider.when('/conversas/iniciar/:id', {
        cache:false,
        templateUrl:'modulos/usuarios/views/usuario_conversa_iniciar.html',
        controller: 'UsuarioConversaIniciarCtrl'
    });

    $routeProvider.when('/encontros/:id', {
        cache:false,
        templateUrl:'modulos/animais/views/listagem-encontros.html',
        controller: 'encontrosCtrl'
    });

    $routeProvider.when('/encontros/matches/:id', {
        cache:false,
        templateUrl:'modulos/animais/views/listagem-encontros-matches.html',
        controller: 'encontrosMatchesCtrl'
    });

    $routeProvider.when('/encontros/detalhes_matches/:id/:meuAnimal', {
        cache:false,
        templateUrl:'modulos/animais/views/detalhes_matches.html',
        controller: 'encontrosDetalhesMatchesCtrl'
    });




        $routeProvider.otherwise('/');
});

pet.run(function($rootScope,$templateCache, $location) {
    var routespermission = ['/','/cadastro/','/lembrete/','/forgot-password/'];

    $rootScope.$on('$viewContentLoaded', function() {
        $templateCache.removeAll();
    });

    $rootScope.$on('$routeChangeStart', function(next, current) { 

        if(routespermission.indexOf($location.path()) == -1){
            console.log($location.path())
           if(!localStorage.getItem('pet-token')){
               $location.path('/');
           }
        }
        if($location.path() == "/"){
             if(localStorage.getItem('pet-token') != null){
                $location.path('/animais/');
             }
        }
    });
});

pet.filter('formata_datetime', function(){
    return function(msg) {

        var data =new Date(msg);
        return data.toLocaleDateString()+" "+data.toLocaleTimeString();
    }
});



pet.filter('concatenaservidor',function(URL_API){
  return function(texto){
    return URL_API+"uploads/"+texto;
  }
});


pet.directive('ngFiles', ['$parse', function ($parse) {

        function fn_link(scope, element, attrs) {
            var onChange = $parse(attrs.ngFiles);
            element.on('change', function (event) {
                onChange(scope, { $files: event.target.files });
            });
        };

        return {
            link: fn_link
        }
} ]);


