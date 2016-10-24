pet.controller('ServicosCtrl', function($scope,ServicosService,$routeParams) {

    $scope.servicos = [];
    var parametro =  $routeParams.id;
    ServicosService.getAllServicosOf(parametro).then(function(dados){
        $scope.servicos = dados.data;
        console.log(dados.data);
    });

})



