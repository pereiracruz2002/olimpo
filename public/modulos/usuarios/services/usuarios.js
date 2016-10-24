pet.factory('UsuariosService', function($http, URL_API){
    var factory = {};


    factory.getByServico = function (servico_id, coords)
    {
        var dados = 'latitude='+coords.latitude+'&longitude='+coords.longitude;
        return $http({
            method: 'POST',
            url: URL_API+'users/hasServico/'+servico_id,
            data: dados,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    }

    factory.preCadastro = function (dados)
    {
        return $http({
            method: 'POST',
            url: URL_API+'user/preCadastro',
            data:dados,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    }

    factory.lembrete = function (email)
    {
        return $http({
            method: 'POST',
            url: URL_API+'user/recuperarSenha',
            data: 'email='+email,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    }

    factory.detalhe = function (users_id)
    {

        return $http({
            method: 'GET',
            url: URL_API+'users/find/'+users_id,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    }

    factory.detalheServico = function (servico,token)
    {

        return $http({
            method: 'GET',
            url: URL_API+'servicos/busca/'+servico+"/"+token,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    }


    factory.curtir = function (servico,token)
    {

        return $http({
            method: 'POST',
            url: URL_API+'servicos/avaliacao',
            data:'user_servicos_id='+servico+"&users_id="+token,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    }

    factory.listagemMeusServicos = function (token)
    {

        return $http({
            method: 'POST',
            url: URL_API+'servicos/meusservicos',
            data:"token="+token,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    }

    factory.cadastrarMeusServicos = function (dados)
    {

        return $http({
            method: 'POST',
            url: URL_API+'usersServicos',
            data:dados,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    }

    factory.deletarMeusServicos = function (dados)
    {

        return $http({
            method: 'POST',
            url: URL_API+'servicos/meusservicos/excluir/',
            data:dados,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    }

    factory.listagemComentariosPrestador = function(servico){
        return $http({
            method: 'POST',
            url: URL_API+'servicos/comentariosPrestador',
            data:"servico="+servico,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    }

    factory.cadastraComentarioPrestador = function(dados){
        return $http({
            method: 'POST',
            url: URL_API+'servicos/cadastraComentariosPrestador',
            data:dados,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    }

    factory.cadastraRespostaPrestador = function(dados){
        return $http({
            method: 'POST',
            url: URL_API+'servicos/cadastraRespostaPrestador/',
            data:dados,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    }


    factory.editaServico = function(dados){
        return $http({
            method: 'POST',
            url: URL_API+"usersServicos/editar",
            data:dados,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    }



    return factory;
});


