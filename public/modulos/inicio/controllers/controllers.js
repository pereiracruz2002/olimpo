pet.controller('InicioCtrl', function($scope,LoginService,$location, $timeout, $log) {
    var _self = this;

    $scope.user = {
        username:'',
        password:''
    }
    $scope.fbLogin = true;

    $scope.login = function(){

        var dados = $("#form-login").serialize();

        LoginService.loginSimple(dados).then(function(retorno){

            if(retorno.data.status == "sucesso"){
                LoginService.setToken(retorno.data.token);
                _self.updatePosition();
                window.location="#/animais/";
            }else{
                alert("usuario ou senha incorretos");
            }

        });
    }
/*
    $timeout(function () {

        facebookConnectPlugin.getLoginStatus(function (response) {
            $log.info(response);
            $scope.fbLogin = true;
            if (response.status === 'connected') {
                LoginService.fbLogin(response.authResponse.accessToken).then(function(result){
                    LoginService.setToken(result.data.token);
                    _self.updatePosition();
                    $location.path('animais');
                })
            } 
        }, function () {
            $scope.fbLogin=false;
            $log.warn('Get Login Status Error');
        });
    }, 1000);
*/

    $scope.facebookLogin = function () {
        

        /*facebookConnectPlugin.login(['email'], function (data) {
            LoginService.fbLogin(data.authResponse.accessToken).then(function(result){
                if(result.data.status == 'ok'){
                    LoginService.setToken(result.data.token);
                    _self.updatePosition();
                    $location.path('animais');
                } else {
                    alert('Não foi possível entrar com seu Facebook');
                }
            });*/

        FB.login(function(response) {
          if (response.status === 'connected') {
            // Logged into your app and Facebook.

            
            LoginService.fbLogin(response.authResponse.accessToken).then(function(result){
                if(result.data.status == 'ok'){
                    LoginService.setToken(result.data.token);
                    _self.updatePosition();
                    $location.path('animais');
                } else {
                    alert('Não foi possível entrar com seu Facebook');
                }

            });
            


          } else if (response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app.
          } else {
            // The person is not logged into Facebook, so we're not sure if
            // they are logged into this app or not.
          }
        }, {scope:'email'})

        //$log.info(data);
    }


    

    _self.updatePosition = function () {
        navigator.geolocation.getCurrentPosition(function(position){
            LoginService.updatePosition(position.coords).then();
        },
        function (error){
            alert('code: '    + error.code    + '\n' + 'message: ' + error.message + '\n');
        });
    };


})
