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

        Route::get('/admin',"PET\Modules\Admin\Controllers\Login@login");

        Route::get('/admin/logout',"PET\Modules\Admin\Controllers\Login@fazLogout");

        Route::post('/admin/fazlogin',"PET\Modules\Admin\Controllers\Login@fazlogin");

        Route::get('/admin/inicio',"PET\Modules\Admin\Controllers\Home@inicio");


        Route::get('/admin/clientes',"PET\Modules\Admin\Controllers\Clientes@Listagem");

        Route::get('/admin/clientes/novo',"PET\Modules\Admin\Controllers\Clientes@Novo");

        Route::post('/admin/clientes/cadastrar',"PET\Modules\Admin\Controllers\Clientes@Cadastro");

        Route::get('/admin/clientes/excluir/{id}',"PET\Modules\Admin\Controllers\Clientes@Excluir");

        Route::get('/admin/clientes/editar/{id}',"PET\Modules\Admin\Controllers\Clientes@Editar");

        Route::post('/admin/clientes/editar',"PET\Modules\Admin\Controllers\Clientes@fazEdicao");


        Route::get('/admin/empresas',"PET\Modules\Admin\Controllers\Empresas@Listagem");

        Route::get('/admin/empresas/novo',"PET\Modules\Admin\Controllers\Empresas@Novo");

        Route::post('/admin/empresas/cadastrar',"PET\Modules\Admin\Controllers\Empresas@Cadastro");

        Route::get('/admin/empresas/excluir/{id}',"PET\Modules\Admin\Controllers\Empresas@Excluir");

        Route::get('/admin/empresas/editar/{id}',"PET\Modules\Admin\Controllers\Empresas@Editar");

        Route::post('/admin/empresas/editar',"PET\Modules\Admin\Controllers\Empresas@fazEdicao");


        Route::get('/admin/animais',"PET\Modules\Admin\Controllers\Animais@Listagem");

        Route::get('/admin/animais/novo',"PET\Modules\Admin\Controllers\Animais@Novo");

        Route::post('/admin/animais/cadastrar',"PET\Modules\Admin\Controllers\Animais@Cadastro");

        Route::get('/admin/animais/excluir/{id}',"PET\Modules\Admin\Controllers\Animais@Excluir");

        Route::get('/admin/animais/editar/{id}',"PET\Modules\Admin\Controllers\Animais@Editar");

        Route::post('/admin/animais/editar',"PET\Modules\Admin\Controllers\Animais@fazEdicao");


        Route::get('/admin/racas',"PET\Modules\Admin\Controllers\Racas@Listagem");

        Route::get('/admin/racas/novo',"PET\Modules\Admin\Controllers\Racas@Novo");

        Route::post('/admin/racas/cadastrar',"PET\Modules\Admin\Controllers\Racas@Cadastro");

        Route::get('/admin/racas/excluir/{id}',"PET\Modules\Admin\Controllers\Racas@Excluir");

        Route::get('/admin/racas/editar/{id}',"PET\Modules\Admin\Controllers\Racas@Editar");

        Route::post('/admin/racas/editar',"PET\Modules\Admin\Controllers\Racas@fazEdicao");
    });
