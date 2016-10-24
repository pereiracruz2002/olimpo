    <?php

    /*
    |--------------------------------------------------------------------------
    | Routes File
    |--------------------------------------------------------------------------
    |
    | Here is where you will register all of the routes in an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */



    /*
    |--------------------------------------------------------------------------
    | Application Routes
    |--------------------------------------------------------------------------
    |
    | This route group applies the "web" middleware group to every route
    | it contains. The "web" middleware group is defined in your HTTP
    | kernel and includes session state, CSRF protection, and more.
    |
    */



    Route::group(['middleware' => ['web']], function () {
        Route::get('/', function () {
            return view('welcome');
        });
    });


    Route::group(['middleware' => 'cors'], function () {

        Route::resource('servicos', 'Servicos');
        Route::get('/user/getAllAnimalsOfUser/{token}', 'Animais@index');
        Route::get('/user/deleteAnimalUser/{id}/{token}', 'Animais@deletar');
        Route::get('/animais/categorias', 'Animais@categorias');
        Route::post('/upload/foto',"Animais@upload");
        Route::post('/animais/cadastrar',"Animais@cadastrar");
        Route::post("/animais/editar","Animais@editar");
        Route::get('/animais/getAnimal/{id}',"Animais@getAnimal");
        Route::post('/animais/getParesAnimal',"Animais@getParesAnimal");
        Route::post('/animais/salvaCombinacao',"Animais@salvaCombinacao");
        Route::get('/animais/getCombinados/{id}',"Animais@listaCombinados");
        Route::post('/animais/descombinar',"Animais@descombinar");
        Route::post('/animais/denunciar',"Animais@denunciar");
        Route::post('/animais/getSalasAnimais',"Animais@getSalasAnimais");
        Route::post('/animais/conversas',"Animais@conversas");
        Route::post('/animais/conversasanteriores',"Animais@conversasanteriores");
        Route::resource('users', 'UsersController');
        Route::post('usersServicos/editar', 'UsersServicos@editar');
        Route::resource('usersServicos', 'UsersServicos');
        Route::post('/user/updatePerfil', 'UsersController@updatePerfil');
        Route::get('/servicos/busca/{post}/{id}','Servicos@busca');
        Route::post('servico/alteraFavorito','Servicos@alteraFavorito');
        Route::get('/users/find/{id}','UsersController@show');
        Route::post('/users/hasServico/{id}', 'UsersController@hasService');
        Route::resource('animais', 'Animais');
        Route::get('/user/getAllAnimalsOfUser/{id}','UsersController@getAllAnimalsOf');
        Route::get('/servicos/getAllServicosOf/{id}','Servicos@getAllServicosOf');
        Route::post('/servicos/avaliacao','Servicos@avaliacao');
        Route::post('/servicos/busca','Servicos@buscar');
        Route::post('/servicos/buscaServicoSite','Servicos@buscaServicosSite');
        Route::post('/servicos/DetalhesEmpresaSite','Servicos@buscaEmpresaSite');
        Route::post('/servicos/meusservicos','Servicos@meusServicos');
        Route::post('/servicos/meusservicos/excluir','Servicos@excluirMeuServico');
        Route::post('/servicos/comentariosPrestador','Servicos@comentariosSobrePrestador');
        Route::post('/servicos/cadastraComentariosPrestador','Servicos@cadastraComentariosSobrePrestador');
        Route::post('/servicos/cadastraRespostaPrestador','Servicos@cadastraRespostaSobrePrestador');
        Route::post('/login/simple','UsersController@loginSimple');
        Route::post('/login/fbLogin', 'UsersController@fbLogin');
        Route::post('/login/updatePosition', 'UsersController@updatePosition');
        Route::post('/user/preCadastro','UsersController@preCadastro');
        Route::post('/salas/{id}','Salas@getSalasUsers');
        Route::post('sala/novaMensagem','Salas@salvaMensagem');
        Route::get('coordenada','UsersServicos@getCoordenada');
        Route::post('sala/novaConversa','Salas@novaConversa');
        Route::post('/user/recuperarSenha','UsersController@recuperarSenha');
        Route::post('user/editar','UsersController@editar');
        Route::resource('doacoes', 'Doacoes', ['except' => [
            'create', 'edit','/doacoes/categorias','/doacoes/getminhasdoacoes'
        ]]);
        Route::post('/doacoes/alterar/status',"Doacoes@alterarStatus");
        Route::post('/doacoes/getminhasdoacoes',"Doacoes@getminhasDoacoes");
        Route::get('/doacoes/categorias/listagem','Doacoes@categorias_doacoes');
        Route::post('/listaItensDisponiveis','Doacoes@ListaItensDisponiveis');
        Route::post('/usuario/busca','UsersController@buscaUsuarioToken');
        Route::post('/listaInteressandosDoacao','Doacoes@listaInteressandosDoacao');
        Route::post("/doacoes/criarSala","Doacoes@criaSala");
        Route::post("/conversas","Salas@getConversas");
        Route::post("/empresas","Empresas@getConversas");
        Route::post('/empresas', 'Empresas@cadastraEmpresa');
        Route::post('/empresas/getAllEmpresasOf','Empresas@getAllEmpresasOf');
        Route::post('/empresas/listaFavoritos','Servicos@listaFavoritos');
        Route::get('/empresas/getEmpresas/{id}','Empresas@buscaDadosEmpresas');
        Route::get('/empresas/getAllEmpresas/', 'Empresas@getAllEmpresas');
        Route::post('/empresas/hasServico','Empresas@hasServico');
        Route::post('/push/AtualizaDadosUsuario','UsersController@AtualizaDadosUsuario');
        Route::post("/notificacoes/listagem","Notificacoes@listagem");
        Route::post("/notificacoes/conversas","Notificacoes@conversas");
        Route::post("/notificacoes/alteraStatus","Notificacoes@alteraStatus");
        Route::post("/notificacoes/alteraStatusUrl","Notificacoes@alteraStatusPorUrl");
        Route::post("/notificacoes/notificacaoCombinacao","Notificacoes@notificacaoCombinacao");
        Route::post('/empresas/editarEmpresas','Empresas@editarEmpresa');
        Route::post('/push/AtualizaDadosUsuario','UsersController@AtualizaDadosUsuario');
        Route::post('/empresas/excluir','Empresas@excluirEmpresa');
        Route::post('/raca/cadastrar','Raca@cadastrar');
        Route::get('/raca/retornaRaca/{id}',"Raca@retornaRaca");
        Route::get('/dicas/doDia',"Dicas@doDia");
        Route::post('/reclamacoes/nova',"Reclamacoes@nova");
        Route::post('/empresas/getAllEmpresasSearch','Empresas@search');

    });
