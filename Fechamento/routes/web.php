<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Welcome
Route::get('/', function () {
    return redirect('/home');// view('welcome');
});

//Testes
Route::get('/phpinfo', function () {

    phpinfo();
    
});

//Master
//Route::get('/master', ['uses'=>'Admin\Master@index', 'as'=>'master.index']);
//Route::post('/master/save', ['uses'=>'Admin\Master@save', 'as'=>'master.save']);


Auth::routes();

Route::post('/loginLdap', ['uses'=>'LoginController@loginLdap', 'as'=>'loginLdap']);

Route::group(['middleware'=>'auth'], function(){
    
    //Route::post('/loginAuth', ['uses'=>'Auth\LoginController@loginLdap', 'as'=>'loginLdap']);



    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/site', ['uses'=>'HomeController@index', 'as'=>'home.index']);

    //Route::get('/site', function(){
    //    return view('site.home');
    //});

    Route::get('/site/tarefa', ['uses'=>'Site\TarefaController@index', 'as'=>'tarefa.index']);
    Route::get('/site/tarefa/concluir/tarefa/{idTarefa}/atividade/{idAtiv}', ['uses'=>'Site\TarefaController@concluir', 'as'=>'tarefa.concluir']);
    Route::post('/site/tarefa/concluir/tarefa/{idTarefa}/concluirAtraso', ['uses'=>'Site\TarefaController@concluirAtraso', 'as'=>'tarefa.concluirAtraso']);
    Route::get('/site/tarefa/reabrir/{id}', ['uses'=>'Site\TarefaController@reabrir', 'as'=>'tarefa.reabrir']);
    Route::put('/site/tarefa/previsao/{id}', ['uses'=>'Site\TarefaController@previsao', 'as'=>'tarefa.previsao']);

    Route::get('/site/pendencia/{id?}', ['uses'=>'Site\PendenciaController@index', 'as'=>'pendencia.index']);
    Route::post('/site/pendencia/trocaPeriodo/{id}', ['uses'=>'Site\PendenciaController@trocaPeriodo', 'as'=>'pendencia.trocaPeriodo']);
    
    Route::get('/site/contas', ['uses'=>'Site\ContaController@index', 'as'=>'contas.index']);
    
    Route::get('/site/customizado', ['uses'=>'Site\CustomizadoController@index', 'as'=>'customizado.index']);
    Route::get('/site/customizado/empresa/{id}', ['uses'=>'Site\CustomizadoController@empresa', 'as'=>'customizado.empresa']);
    Route::get('/site/customizado/gerencia/{id}', ['uses'=>'Site\CustomizadoController@gerencia', 'as'=>'customizado.gerencia']);
    Route::get('/site/customizado/dia/{id}', ['uses'=>'Site\CustomizadoController@dia', 'as'=>'customizado.dia']);
    
    Route::get('/site/relatorio', ['uses'=>'Site\RelatorioController@index', 'as'=>'relatorio.index']);
    Route::post('/site/relatorio/gerarRelatorio/{idRel}', ['uses'=>'Site\RelatorioController@gerarRelatorio', 'as'=>'relatorio.gerarRelatorio']);

    Route::get('/site/periodo', ['uses'=>'Site\PeriodoHistController@index', 'as'=>'periodoHist.index']);

    Route::get('/site/comentario', ['uses'=>'Site\ComentarioController@index', 'as'=>'comentario.index']);
    Route::post('/site/comentario/salvar', ['uses'=>'Site\ComentarioController@salvar', 'as'=>'comentario.salvar']);
    Route::post('/site/comentario/responder/{id}', ['uses'=>'Site\ComentarioController@responder', 'as'=>'comentario.responder']);
    
    Route::get('/site/user', ['uses'=>'Site\UserController@index', 'as'=>'user.index']);
    Route::post('/site/user/update', ['uses'=>'Site\UserController@update', 'as'=>'user.update']);
    
    
    Route::get('/site/CalendarioController', ['uses'=>'Site\CalendarioController@index', 'as'=>'calend.calend']);

    Route::get('/commandTestBotSicredi', ['uses'=>'Bot\ChatInf@index', 'as'=>'chatbot.bot']);
    Route::get('/commandTestBotSicredi/chat', ['uses'=>'Bot\ChatInf@chat', 'as'=>'chatbot.chat']);


//teste de envio de email
//Route::get('/site/email', ['uses'=>'Site\EmailController@index', 'as'=>'email.index']);


    // TELAS DE ADMINISTRAÇÃO DA PÁGINA
    Route::get('/admin', ['uses'=>'Admin\AdminController@index', 'as'=>'admin.index']);
    Route::post('/admin/resultadoSwitch/{id}', ['uses'=>'Admin\AdminController@resultadoSwitch', 'as'=>'admin.resultadoSwitch']);
    Route::post('/admin/periodoSwitch/{id}', ['uses'=>'Admin\AdminController@periodoSwitch', 'as'=>'admin.periodoSwitch']);

    // Gerencia 
    Route::get('/admin/gerencia', ['uses'=>'Admin\GerenciaController@index', 'as'=>'gerencia.index']);
    Route::post('/admin/gerencia/salvar', ['uses'=>'Admin\GerenciaController@salvar', 'as'=>'gerencia.salvar']);
    Route::put('/admin/gerencia/atualizar/{id}', ['uses'=>'Admin\GerenciaController@atualizar', 'as'=>'gerencia.atualizar']);
    Route::get('/admin/gerencia/deletar/{id}', ['uses'=>'Admin\GerenciaController@deletar', 'as'=>'gerencia.deletar']);

    // Empresa 
    Route::get('/admin/empresa', ['uses'=>'Admin\EmpresaController@index', 'as'=>'empresa.index']);
    Route::post('/admin/empresa/salvar', ['uses'=>'Admin\EmpresaController@salvar', 'as'=>'empresa.salvar']);
    Route::put('/admin/empresa/atualizar/{id}', ['uses'=>'Admin\EmpresaController@atualizar', 'as'=>'empresa.atualizar']);
    Route::get('/admin/empresa/deletar/{id}', ['uses'=>'Admin\EmpresaController@deletar', 'as'=>'empresa.deletar']);

    // Período 
    Route::get('/admin/periodo', ['uses'=>'Admin\PeriodoController@index', 'as'=>'periodo.index']);
    Route::post('/admin/periodo/salvar', ['uses'=>'Admin\PeriodoController@salvar', 'as'=>'periodo.salvar']);
    Route::put('/admin/periodo/atualizar/{id}', ['uses'=>'Admin\PeriodoController@atualizar', 'as'=>'periodo.atualizar']);
    Route::get('/admin/periodo/deletar/{id}', ['uses'=>'Admin\PeriodoController@deletar', 'as'=>'periodo.deletar']);

    // Usuário 
    Route::get('/admin/usuario', ['uses'=>'Admin\UsuarioController@index', 'as'=>'usuario.index']);
    Route::post('/admin/usuario/salvar', ['uses'=>'Admin\UsuarioController@salvar', 'as'=>'usuario.salvar']);
    Route::put('/admin/usuario/atualizar/{id}', ['uses'=>'Admin\UsuarioController@atualizar', 'as'=>'usuario.atualizar']);
    Route::get('/admin/usuario/deletar/{id}', ['uses'=>'Admin\UsuarioController@deletar', 'as'=>'usuario.deletar']);
    
    // Atividade 
    Route::get('/admin/atividade', ['uses'=>'Admin\AtividadeController@index', 'as'=>'atividade.index']);
    Route::post('/admin/atividade/salvar', ['uses'=>'Admin\AtividadeController@salvar', 'as'=>'atividade.salvar']);
    Route::put('/admin/atividade/atualizar/{id}', ['uses'=>'Admin\AtividadeController@atualizar', 'as'=>'atividade.atualizar']);
    Route::put('/admin/atividade/backup/{id}', ['uses'=>'Admin\AtividadeController@backup', 'as'=>'atividade.backup']);
    Route::get('/admin/atividade/deletar/{id}', ['uses'=>'Admin\AtividadeController@deletar', 'as'=>'atividade.deletar']);

    // Dependencia 
    Route::get('/admin/dependencia', ['uses'=>'Admin\DependenciaController@index', 'as'=>'dependencia.index']);
    Route::post('/admin/dependencia/salvar', ['uses'=>'Admin\DependenciaController@salvar', 'as'=>'dependencia.salvar']);
    Route::put('/admin/dependencia/atualizar/{id}', ['uses'=>'Admin\DependenciaController@atualizar', 'as'=>'dependencia.atualizar']);
    Route::get('/admin/dependencia/deletar/{id}', ['uses'=>'Admin\DependenciaController@deletar', 'as'=>'dependencia.deletar']);

    // Feriado 
    Route::get('/admin/feriado', ['uses'=>'Admin\FeriadoController@index', 'as'=>'feriado.index']);
    Route::post('/admin/feriado/salvar', ['uses'=>'Admin\FeriadoController@salvar', 'as'=>'feriado.salvar']);
    Route::put('/admin/feriado/atualizar/{id}', ['uses'=>'Admin\FeriadoController@atualizar', 'as'=>'feriado.atualizar']);
    Route::get('/admin/feriado/deletar/{id}', ['uses'=>'Admin\FeriadoController@deletar', 'as'=>'feriado.deletar']);

    //Auth::routes();

    //Route::get('/home', 'HomeController@index')->name('home');

    //Auth::routes();

    //Route::get('/home', 'HomeController@index')->name('home');

});

//Route::view('/tvSlide1', 'tv.slide1');


Route::get('/cache', function(){

    /*
    $usuario_id = \Auth::id();
    $usuario = \App\User::find($usuario_id);
    if ($usuario->nivel > 1){
        return redirect()->route('home.index');
    }
    */

    //exec('composer dump-autoload');
    //echo '<h1>Dump Autoload</h1>';
    
    //Clear Cache facade value:
    $exitCode = Artisan::call('cache:clear');
    echo '<h1>Cache facade value cleared</h1>';

    //Reoptimized class loader:
    $exitCode = Artisan::call('optimize');
    echo '<h1>Reoptimized class loader</h1>';

    //Route cache:
    //$exitCode = Artisan::call('route:cache');
    //echo '<h1>Routes cached</h1>';

    //Clear Route cache:
    $exitCode = Artisan::call('route:clear');
    echo '<h1>Route cache cleared</h1>';

    //Clear View cache:
    $exitCode = Artisan::call('view:clear');
    echo '<h1>View cache cleared</h1>';

    //Clear Config cache:
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';

    //Clear View cache:
    //$exitCode = Artisan::call('schedule:run');
    //return '<h1>Schedule criado</h1>';

});


/*Route::get('/commandArtisan', function(){
    $exitCode = Artisan::call('make:command', [
        'name' => 'SendNoPrevision',
        '--command' => 'email:noPrevision'
    ]);
    return '<h1>Comando executado</h1>';
});*/


Route::get('/commandArtisan', function(){
    $exitCode = Artisan::call('email:noPrevision');
    return '<h1>Envio</h1>';
});


//Route::post('/commandTestBotSicredi');


Route::post('/site/pendencia/trocaPeriodo/{id}', ['uses'=>'Site\PendenciaController@trocaPeriodo', 'as'=>'pendencia.trocaPeriodo']);

Route::get('/excel', ['uses' => 'Site\PendenciaController@excel', 'as' => 'pendencia.excel']);