<?php

Route::get('/', function () {  return redirect()->route('register'); });
Auth::routes();
Route::post('/polos', 'MinhaConta\InscricaoController@getPolos', ['middleware' => 'csrf'])->name('inscricao.polos');

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'middleware' => 'admin', 'as' => 'admin.'], function () {
    // Home
    Route::get('/', 'Admin\AdminController@index')->name('home');

    // Polos
    Route::group(['prefix' => '/polos', 'as' => 'polos.'], function () {
        // Home - Polos
        Route::get('/', 'Admin\PolosController@index')->name('home');
        Route::get('/adicionar', 'Admin\PolosController@adicionar')->name('adicionar');
        Route::post('/adicionarPolo', 'Admin\PolosController@adicionarPolo')->name('adicionarPolo');
        Route::get('/todos', 'Admin\PolosController@getPolos')->name('todos');
        Route::get('/ver/{id}', 'Admin\PolosController@ver')->name('ver');
        Route::get('/editar/{id}', 'Admin\PolosController@editar')->name('editar');
        Route::post('/salvar/{id}', 'Admin\PolosController@salvar')->name('salvar');
    });

    // // Socioeconômico
    // Route::group(['prefix' => '/socioeconomico', 'as' => 'socioeconomico.'], function () {
    //     // Home - Socioeconômico
    //     Route::get('/', 'MinhaConta\SocioeconomicoController@index')->name('home');
    //     Route::get('/todos', 'MinhaConta\SocioeconomicoController@getSocio')->name('todos');
    //     Route::get('/lancar/{id}', 'MinhaConta\SocioeconomicoController@lancar')->name('lancar');
    // });
    //
    // Route::group(['prefix' => '/reserva', 'as' => 'reserva.'], function () {
    //     // Home - Reserva de Vagas
    //     Route::get('/', 'Admin\ReservaController@index')->name('home');
    //     Route::get('/todos', 'Admin\ReservaController@getReserva')->name('todos');
    //     Route::get('/lancar/{id}', 'Admin\ReservaController@lancar')->name('lancar');
    // });

    // Cursos
    Route::group(['prefix' => '/cursos', 'as' => 'cursos.'], function () {
        // Home - Cursos
        Route::get('/', 'Admin\CursosController@index')->name('home');
        Route::get('/adicionar', 'Admin\CursosController@adicionar')->name('adicionar');
        Route::post('/adicionarCurso', 'Admin\CursosController@adicionarCurso')->name('adicionarCurso');
        Route::get('/todos', 'Admin\CursosController@getCursos')->name('todos');
        Route::get('/ver/{id}', 'Admin\CursosController@ver')->name('ver');
        Route::get('/editar/{id}', 'Admin\CursosController@editar')->name('editar');
        Route::post('/salvar/{id}', 'Admin\CursosController@salvar')->name('salvar');
    });

    // Candidatos
    Route::group(['prefix' => '/candidatos', 'as' => 'candidatos.'], function () {
        // Home - Candidatos
        Route::get('/', 'Admin\AdminController@todos')->name('home');
        Route::get('/curso_polo', 'Admin\AdminController@curso_polo')->name('curso_polo');
        Route::post('/listar', 'Admin\AdminController@listar')->name('listar');
        Route::get('/getCursoPolo', 'MinhaConta\InscricaoController@getCursoPolo')->name('getCursoPolo');
        Route::get('/ver_todos', 'Admin\AdminController@ver_todos')->name('ver_todos');
        Route::get('/ver/{id}', 'Admin\AdminController@ver')->name('ver');
        Route::get('/editar/{id}', 'Admin\AdminController@editar')->name('editar');
        Route::get('/isentar/{id}', 'Admin\AdminController@isentar')->name('isentar');
        Route::post('/salvar', 'Admin\AdminController@salvar')->name('salvar');
        Route::get('/receber_envelope', 'Admin\RecursoController@receber_envelope')->name('receber');
        Route::get('/verificar_envelope', 'Admin\RecursoController@verificar_envelope')->name('verificar');
        Route::post('/recebimento_envelope', 'Admin\RecursoController@recebimento_envelope')->name('recebimento_envelope');
        Route::get('/analise_documento/{id}', 'Admin\RecursoController@analise_documento')->name('analise_documento');
        Route::post('/analise', 'Admin\RecursoController@analise')->name('analise');
    });

    // Recursos
    Route::group(['prefix' => '/recursos', 'as' => 'recursos.'], function () {

        Route::get('/', 'Admin\RecursoController@index')->name('home');
        Route::get('/abertos', 'Admin\RecursoController@abertos')->name('abertos');
        Route::post('/resposta/{id}', 'Admin\RecursoController@resposta')->name('resposta');
        Route::get('/abertos/todos', 'Admin\RecursoController@getAbertos')->name('abertos.todos');
        Route::get('/respondidos', 'Admin\RecursoController@respondidos')->name('respondidos');
        Route::post('/responder', 'Admin\RecursoController@responder')->name('responder');
        Route::post('/ver/{id}', 'Admin\RecursoController@ver')->name('ver');
        Route::get('/respondidos/todos', 'Admin\RecursoController@getRespondidos')->name('respondidos.todos');
    });
});

Route::group(['prefix' => 'minhaconta', 'middleware' => 'auth', 'as' => 'minhaconta.'], function(){
    Route::get('/', 'MinhaConta\InscricaoController@index')->name('home');
    Route::get('/meus_dados', 'MinhaConta\InscricaoController@meus_dados')->name('meus_dados');
    Route::post('/salvar', 'MinhaConta\InscricaoController@salvar')->name('salvar');
    Route::get('/senha', 'MinhaConta\InscricaoController@senha')->name('senha');
    Route::post('/alterar_senha', 'MinhaConta\InscricaoController@alterar_senha')->name('alterar_senha');
    Route::get('/dae', 'MinhaConta\InscricaoController@dae')->name('dae');
    Route::get('/socioeconomico/inscrever', 'MinhaConta\SocioeconomicoController@formSocio')->name('socioeconomico.inscrever');
    Route::post('/socioeconomico/salvar', 'MinhaConta\SocioeconomicoController@store')->name('socioeconomico.salvar');
    Route::get('/socioeconomico/questionario', 'MinhaConta\SocioeconomicoController@respostasQuestionario')->name('socioeconomico.questionario');
    Route::get('/socioeconomico/comprovante', 'MinhaConta\SocioeconomicoController@comprovanteSocio')->name('socioeconomico.comprovante');
    Route::get('/socioeconomico/declaracao', 'MinhaConta\InscricaoController@declaracao')->name('socioeconomico.declaracao');
    Route::get('comprovante', 'MinhaConta\ComprovanteController@pdf')->name('comprovante');
    Route::get('/recurso', 'MinhaConta\InscricaoController@recurso')->name('recurso');
    Route::post('/recurso_usuario', 'MinhaConta\InscricaoController@recurso_usuario')->name('recurso_usuario');
    Route::get('/resposta/{id}', 'MinhaConta\InscricaoController@resposta')->name('resposta');
    Route::get('/novainscricao', 'MinhaConta\InscricaoController@novainscricao')->name('novainscricao');
    Route::post('/novainscricao/salvar', 'MinhaConta\InscricaoController@novainscricao_salvar')->name('novainscricao.salvar');
    Route::post('/cancelar_inscricao', 'MinhaConta\InscricaoController@cancelar_inscricao')->name('cancelar_inscricao');
    Route::get('/atualiza_vencimento', 'MinhaConta\InscricaoController@atualiza_vencimento')->name('atualiza_vencimento');
});

Route::get('/home', function () {  return redirect()->route('admin.home'); });
