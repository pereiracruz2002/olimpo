pet.factory('ServicosService', function($http, URL_API){
    var factory = {};


    factory.getServicosAll = function ()
    {
        return $http({
            method: 'GET',
            url: URL_API+'servicos',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    }

    factory.getAllServicosOf = function (id)
    {
        return $http({
            method: 'GET',
            url: URL_API+'servicos/getAllServicosOf/'+id,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    }

    return factory;
});


