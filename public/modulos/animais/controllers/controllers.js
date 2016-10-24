pet.controller('AnimaisCtrl', function($scope,AnimaisService,LoginService) {

	$scope.animais = [];

	var token = LoginService.getToken();

	AnimaisService.getAnimalsUser(token).then(function(dados){

		$scope.animais = dados.data;

		console.log($scope.animais);

	});

});

pet.controller('MeusAnimaisCtrl', function($scope,AnimaisService,LoginService) {


	$scope.animais = [];

	var token = LoginService.getToken();

	AnimaisService.getAnimalsUser(token).then(function(dados){

		$scope.animais = dados.data;

		console.log($scope.animais);

	});

	$scope.excluir = function(animal){

		AnimaisService.deleteAnimalUser(animal,token).then(function(retorno){
			if(retorno.data.status == "sucesso"){

				$scope.animais  = retorno.data.animais;

			}else{
				alert("Não foi possivel excluir, tente novamente mais tarde");
			}
		});

	}

});


pet.controller('MeusAnimaisNovoCtrl', function($scope,AnimaisService,LoginService,URL_API,$http) {


	$scope.token = LoginService.getToken();

	$scope.tipos = [];


	$scope.getTheFiles = function ($files) {

		var formdata = new FormData();

		angular.forEach($files, function (value, key) {
			formdata.append('arquivo', value);
		});

		var request = {
			method: 'POST',
			url: URL_API+"upload/foto",
			data: formdata,
			headers: {
				'Content-Type': undefined
			}
		};

		// SEND THE FILES.
		$http(request)
			.success(function (d) {
				$("#imagem").val(d.trim());
			})
			.error(function () {
			});
	};




	AnimaisService.buscaAnimaisCategorias().then(function(retorno){

		$scope.tipos = retorno.data;

	});

	$scope.imagem = function(){




	}


	$scope.cadastrar = function(){
		var dados = $("#cadastroAnimais").serialize();

		AnimaisService.cadastrar(dados).then(function(retorno){

			if(retorno.data.status == "sucesso"){

				location.href = "#/meus-animais/";

			}else{
				alert("Não foi possivel efetuar o cadastro no momento");
			}

		});


	}





});


pet.controller('MeusAnimaisEditarCtrl', function($scope,AnimaisService,LoginService,$routeParams,URL_API,$http) {

	$scope.animais_id = $routeParams.id;

	$scope.token = LoginService.getToken();

	$scope.tipos = [];

	$scope.animal = "";

	$scope.api = URL_API;



	AnimaisService.buscaAnimaisCategorias().then(function(retorno){

		$scope.tipos = retorno.data;

	});

	AnimaisService.getAnimal($scope.animais_id).then(function(retorno){

		//console.log(retorno);

		$scope.animal = retorno.data;

	});

	$scope.getTheFiles = function ($files) {

		var formdata = new FormData();

		angular.forEach($files, function (value, key) {
			formdata.append('arquivo', value);
		});

		var request = {
			method: 'POST',
			url: URL_API+"upload/foto",
			data: formdata,
			headers: {
				'Content-Type': undefined
			}
		};

		// SEND THE FILES.
		$http(request)
			.success(function (d) {
				$("#imagem").val(d.trim());
			})
			.error(function () {
			});
	};


	$scope.editar = function(){

		var dados = $("#editarAnimais").serialize();

		AnimaisService.editar(dados).then(function(retorno){


			if(retorno.data.status == "sucesso"){

				location.href = "#/meus-animais/";

			}else{
				alert("Não foi possivel editar o cadastro no momento");
			}

		});



	}


});


pet.controller('encontrosCtrl', function($scope,$routeParams,AnimaisService,LoginService) {

	$scope.animais = [];

	$scope.animais_id = $routeParams.id;

	var token = LoginService.getToken();

	var inicia = 0;

	var contador = 0;

	var quantidade = 50;

	var listaDeRejeitados = {"rejeitados":[]};


	AnimaisService.getMeeting($scope.animais_id,inicia,quantidade,listaDeRejeitados).then(function(retorno){

		$scope.animais = retorno.data;

		$scope.animal = $scope.animais[contador];


		quantidade = $scope.animais.length;


		//console.log($scope.animal);

	});

	$scope.descartar = function(id_animal){



		var animal1 = $scope.animais_id;
		var animal2 = id_animal;
		listaDeRejeitados.rejeitados.push(id_animal);

		//console.log(listaDeRejeitados);

		quantidade = $scope.animais.length;

		delete($scope.animais[contador]);
		contador++;

		if(contador == quantidade){
			$scope.animais = [];

			AnimaisService.getMeeting($scope.animais_id,inicia,quantidade,listaDeRejeitados).then(function(retorno){

				$scope.animais = retorno.data;

				if($scope.animais.length > "0"){
					contador = 0;
					$scope.animal = $scope.animais[contador];

				}

			});



		}else{

			$scope.animal = $scope.animais[contador];
		}

	}


	$scope.par = function(animal){

		var animal1 = $scope.animais_id;

		var animal2 = animal;

		AnimaisService.makeMatching(animal1,animal2).then(function(retorno){});


		delete($scope.animais[contador]);

		contador++;

		if(contador == quantidade){
			$scope.animais = [];



			AnimaisService.getMeeting($scope.animais_id,inicia,quantidade,listaDeRejeitados).then(function(retorno){

				$scope.animais = retorno.data;



				if($scope.animais.length > "0"){
					contador = 0;
					$scope.animal = $scope.animais[contador];

				}else{
					$scope.animal = [];
				}

			});



		}else{

			$scope.animal = $scope.animais[contador];
		}


	}



});


pet.controller('encontrosMatchesCtrl', function($scope,$routeParams,AnimaisService,LoginService) {




	$scope.animais_id = $routeParams.id;



	$scope.animais = [];


	AnimaisService.getListCombination($scope.animais_id).then(function(retorno){

		$scope.animais = retorno.data;


	});







});




pet.controller('encontrosDetalhesMatchesCtrl', function($scope,$routeParams,AnimaisService,LoginService,URL_SOCKET,URL_API) {



	var socket = io.connect(URL_SOCKET);


	$("#mostra-menu").on("click",function(){
		$(".opcoes").slideToggle("slow");
	});



	$('#opt-denuncia').hide();
	$('#denuncias textarea').hide();
	$scope.sala = '';
	$scope.animais_id = $routeParams.id;
	$scope.meuAnimal = $routeParams.meuAnimal;




	$scope.salas = [];

	var token = LoginService.getToken();
	var meu_animal = $scope.meuAnimal;

	AnimaisService.getSalaAnimal($scope.animais_id,$scope.meuAnimal).then(function(retorno){

		$scope.sala = retorno.data[0].salas_combinacoes_id;


		AnimaisService.conversas($scope.sala).then(function(retorno){

			$scope.conversas= retorno.data;



		});


	});






	$scope.mostrarOpcaoDenuncia = function(){
		$('#opt-denuncia').show();
		$(".opcoes").slideToggle("slow");

	}



	//$scope.sala = $stateParams.sala;


	AnimaisService.getAnimal($scope.meuAnimal).then(function(retorno){




		socket.emit('entrou', { "sala":  $scope.sala,"animal":retorno.data});

	});

	$scope.$on('$ionicView.leave', function(){
		socket.emit('sair', { "sala": $scope.sala});

	});





	$scope.showTextarea = function(){
		$('#denuncias textarea').show();
	}

	$scope.hideTextarea = function(){
		$('#denuncias textarea').hide();
	}

	$scope.denunciar = function(id_animal){
		var dados = $( "input:radio:checked" ).val();
		console.log(dados)
		if(dados=="Outros"){
			dados = $( "#texto" ).val();
		}
		AnimaisService.denunciar($scope.animais_id,token,dados).then(function(retorno){

			if(retorno.data.status == "sucesso"){
				location.href="#/encontros/matches/"+meu_animal;
			}


		});


	}

	$scope.descombinar = function(){

		var animal_id = $scope.animais_id;

		var meu_animal = $scope.meuAnimal;

		AnimaisService.descombinar(animal_id,meu_animal).then(function(retorno){
			if(retorno.data.status == "sucesso"){
				location.href="#/encontros/matches/"+meu_animal;
			}
		});



	}


	$scope.enviarMensagem = function(){

		var mensagem = $('#enviaconversas #mensagem').val();
		var sala = $('#enviaconversas #sala').val();
		var animais_id = $('#enviaconversas #animais_id').val();
		socket.emit('envia-mensagem', { "sala":sala, "mensagem":mensagem ,"animais_id":animais_id});
		$('#mensagem').val('')
	}


	socket.on("adicionaMensagem",function(data){



		AnimaisService.getAnimal(data.animais_id).then(function(retorno){



			var html = "<a class='item item-avatar'>";
			html+="<img src='"+URL_API+"uploads/"+retorno.data.imagem+"'>";
			html+="<h2>"+retorno.data.nome+"</h2>";
			html+="<p>"+data.hora+":"+data.mensagem+"</p>";
			html+="</a>";

			$('#conversas').append(html);

		});





	});



});

