pet.controller('UsuariosServicoCtrl', function($scope, UsuariosService, $routeParams) {
    $scope.usuarios = [];
    $scope.loading = true;

    navigator.geolocation.getCurrentPosition(function(position){
        UsuariosService.getByServico($routeParams.servico_id, position.coords).then(function(dados){
            $scope.usuarios = dados.data;
        });
    },
    function (error){
        alert('code: '    + error.code    + '\n' + 'message: ' + error.message + '\n');
    });
})

pet.controller('CadastroServicoCtrl', function($scope,UsuariosService) {
	$scope.msg=[];
   $scope.cadastrar= function(){

   		var dados = $("#form-cadastro-usuario").serialize();
	    $scope.msg=[];

   		UsuariosService.preCadastro(dados).then(function(retorno){

   			if(retorno.data.status == "sucesso"){
   				alert(retorno.data.msg);
   				window.location="#/login";
   			} else {
   				alert(retorno.data.msg);
   			}

   		},function errorCallback(response) {
			angular.forEach(response.data, function(value, key) {
				var valor = JSON.stringify(value);
				var formato = valor.replace(/["\[\]]/gi,'');
				$scope.msg.push(formato);
			});

		});


   }


})

pet.controller('LembreteCtrl', function($scope, UsuariosService){
	$scope.myModel= {};
	$scope.myModel.email = '';
	$scope.myModel.loading = false;
	$scope.goTo = function(path){
		window.location="#/path";
	}
	$scope.recuperarSenha = function () {
		$scope.erro = '';
		$scope.sucesso = '';
		$scope.myModel.loading = true;
		UsuariosService.lembrete($scope.myModel.email).then(function(response){
			$scope.myModel.loading = false;
			if(response.data.status == 'erro'){
				$scope.erro = response.data.msg;
			} else {
				$scope.sucesso = response.data.msg;
			}
		});
	}
})

pet.controller('UsuariosServicoDetalhesCtrl', function($scope, UsuariosService,$routeParams,LoginService){
	$scope.detalhes = [];
	$scope.comentarios = [];
	  $scope.myModel = {comentario:""}
	var parametro =  $routeParams.usuario_id;

	$scope.servico = $routeParams.usuario_id;

	console.log(parametro);

	var token = LoginService.getToken();

	$scope.token = token;

	UsuariosService.detalheServico(parametro,token).then(function(dados){
		$scope.detalhes = dados.data;
		console.log(dados.data);
	});

	UsuariosService.listagemComentariosPrestador(parametro).then(function(dados){
		$scope.comentarios = dados.data;
		console.log(dados.data);
	});

	$scope.curtir = function(servico){

		UsuariosService.curtir(servico,token).then(function(retorno){

			$scope.detalhes.curtida = retorno.data.like;
			$scope.detalhes.qtdGostei = retorno.data.qtdGostei;
			$scope.detalhes.qtdNaoGostei = retorno.data.qtdNaoGostei;


		});



	}

	$scope.cadastraComentario = function(){

		var dados = $("#form-comentario").serialize();

		console.log(dados);

		UsuariosService.cadastraComentarioPrestador(dados).then(function(retorno){

			if(retorno.data.status == "sucesso"){
				$scope.comentarios = retorno.data.comentarios;
				  $scope.myModel.comentario="";
			}else{
				alert("Houve um erro ao inserir seu comentário tente novamente mais tarde");
			}

		});
	}

	$scope.cadastraResposta = function(event){

		var dados = $(event.target).serialize();


		UsuariosService.cadastraRespostaPrestador(dados).then(function(retorno){
			if(retorno.data.status == "sucesso"){
				$scope.comentarios = retorno.data.comentarios;
				 
			}else{
				alert("Houve um erro ao inserir sua resposta tente novamente mais tarde");
			}
		});

		
	}



})

pet.controller('ListagemMeusServicosCtrl', function($scope,$routeParams,UsuariosService,LoginService) {
    
    var token = LoginService.getToken();

    $scope.servicos = []; 

  

	UsuariosService.listagemMeusServicos(token).then(function(retorno){


		$scope.servicos = retorno.data;

		//console.log($scope.servicos);

	});

	$scope.excluir=function(servico){

		var dados = "servico="+servico+"&token="+token;

		UsuariosService.deletarMeusServicos(dados).then(function(retorno){

			$scope.servicos=retorno.data;



		});	

	}


})

pet.controller('NovoMeusServicosCtrl', function($scope,$routeParams,UsuariosService,LoginService,ServicosService) {
    
    $scope.token = LoginService.getToken();

    $scope.servicos = []; 



    ServicosService.getServicosAll().then(function(retorno){
    	$scope.servicos = retorno.data;

    });

    $scope.msg = [];

    $scope.cadastrar= function(){

    	var dados = $("#cadastroServico").serialize();


    	UsuariosService.cadastrarMeusServicos(dados).then(function(retorno){

    		if(retorno.data.status == "sucesso"){

    			window.location="#/meus-servicos/listagem/";
    		
    		}else{

    			alert(retorno.data.msg);

    		}


    	},function errorCallback(response) {

    		console.log(response.data);
			angular.forEach(response.data, function(value, key) {
				var valor = JSON.stringify(value);
				var formato = valor.replace(/["\[\]]/gi,'');
				$scope.msg.push(formato);
			});

		});




    }




})


pet.controller('EditarMeusServicosCtrl', function($scope,$routeParams,UsuariosService,LoginService,ServicosService) {
    
    $scope.token = LoginService.getToken();

    $scope.servico = $routeParams.id;


    $scope.servicos = []; 



    ServicosService.getServicosAll().then(function(retorno){
    	$scope.servicos = retorno.data;

    });

    


    $scope.msg = [];


    UsuariosService.detalheServico($scope.servico,$scope.token).then(function(retorno){
    	$scope.cnpj = retorno.data.cnpj;
    	$scope.descricao = retorno.data.descricao;
    	$scope.endereco = retorno.data.enderecos.endereco;
    	$scope.bairro = retorno.data.enderecos.bairro;
    	$scope.complemento = retorno.data.enderecos.complemento;
    	$scope.cidade = retorno.data.enderecos.cidade;
    	$scope.estado = retorno.data.enderecos.estado;
    	$scope.cep = retorno.data.enderecos.cep;
    	$scope.telefone = retorno.data.enderecos.telefone;
    	$scope.celular = retorno.data.enderecos.celular;
    	$scope.tipo = retorno.data.servicos_id;
    });


    $scope.editar= function(){

    	var dados = $("#editarServico").serialize();

    	UsuariosService.editaServico(dados).then(function(retorno){

    		if(retorno.data.status == "sucesso"){



    		}else{
    			alert("desculpe não foi possivel editar o serviço, tente novamente mais tarde");
    		}

    	});

    }




    

    



})

