pet.factory('LoginService', function($http, URL_API){
    var factory = {};


    factory.loginSimple = function (dados) 
    {
        return $http({
            method: 'POST',
            url: URL_API+'login/simple',
            data:dados,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    }

    factory.fbLogin = function (accessToken) 
    {
        return $http({
            method: 'POST',
            url: URL_API+'login/fbLogin',
            data:'accessToken='+accessToken,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    }

    factory.updatePosition= function (coords) 
    {
        var dados = 'latitude='+coords.latitude+'&longitude='+coords.longitude+'&token='+localStorage.getItem("pet-token");
        return $http({
            method: 'POST',
            url: URL_API+'login/updatePosition',
            data:dados,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    }


    factory.setToken = function(token){

        localStorage.setItem("pet-token", token);

    }

    factory.getToken = function(){

        return localStorage.getItem("pet-token");
    }


    factory.logout = function(){

        localStorage.removeItem("pet-token");

    }





    return factory;
});
