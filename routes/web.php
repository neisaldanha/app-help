<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\HistoricoFechadoController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DemandaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PessoasController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ChamadosController;
use App\Http\Controllers\DepartamentosController;
use App\Http\Controllers\FuncaoController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ClientesController;

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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::post('/auth/check', [UsuariosController::class, 'check']);
Route::post('/auth/check', [UsuariosController::class, 'check'])->name('auth.check');
Route::get('/auth/logout', [UsuariosController::class, 'logout'])->name('auth.logout');


Route::group(['middleware' => ['AuthCheck']], function () {

    // Routes Users
    Route::get('/auth/login', [UsuariosController::class, 'login'])->name('auth.login');
    Route::get('/adm/home', [UsuariosController::class, 'dashboard']);
    Route::get('/adm/users', [UsuariosController::class, 'index'])->name('adm.users');
    Route::get('/adm/register-user/{id}', [UsuariosController::class, 'show']);
    Route::get('/adm/ver/user/{id}', [UsuariosController::class, 'show']);
    Route::post('/adm/store', [UsuariosController::class, 'store']);
    Route::get('/adm/user/delete/{id}', [UsuariosController::class, 'destroy']);

    // Rotas Administrativo - Departamentos
    Route::get('/admin/departamentos', [DepartamentosController::class, 'index']);
    Route::get('/admin/novo-departamento', [DepartamentosController::class, 'store']);
    Route::get('/admin/edita-departamento/{id}', [DepartamentosController::class, 'update']);
    Route::get('/admin/exclui-departamento/{id}', [DepartamentosController::class, 'destroy']);

    // Rotas Administrativo - Empresa/Clientes
    Route::get('/admin/lista-clientes', [ClientesController::class, 'index']);
    Route::get('/admin/list-chamados-empresa', [ClientesController::class, 'create']);
    Route::get('/admin/novo-cliente', [ClientesController::class, 'store']);
    Route::get('/admin/edita-cliente/{id}', [ClientesController::class, 'update']);
    Route::get('/admin/exclui-cliente/{id}', [ClientesController::class, 'destroy']);

    //Rota Demandas
    Route::get('/admin/nova-demanda', [DemandaController::class, 'store']);
    Route::get('/admin/edita-demanda/{id}', [DemandaController::class, 'update']);
    Route::get('/admin/exclui-demanda/{id}', [DemandaController::class, 'destroy']);
    Route::get('/admin/lista-demandas', [DemandaController::class, 'index']);

    // Rotas Administrativo - Funções
    Route::get('/admin/funcoes', [FuncaoController::class, 'index']);
    Route::get('/admin/nova-funcao', [FuncaoController::class, 'store']);
    Route::get('/admin/edita-funcao/{id}', [FuncaoController::class, 'update']);
    Route::get('/admin/exclui-funcao/{id}', [FuncaoController::class, 'destroy']);

    // Rotas Painel
    Route::get('/painel/lista-pessoas', [PessoasController::class, 'index']);
    Route::get('/painel/edit/{id}', [PessoasController::class, 'show']);
    Route::post('/painel/store', [PessoasController::class, 'store'])->name('painel.save');
    Route::get('/painel/pessoa/delete/{id}', [PessoasController::class, 'destroy'])->name('painel.pessoas');

    //CHAMADOS
    Route::get('/painel/lista-chamados', [ChamadosController::class, 'index']);
    Route::get('/painel/lista-chamados-dpto-finalizados', [ChamadosController::class, 'chamadosFinalizados']);
    Route::get('/painel/relatorio-chamados-finalizados', [ChamadosController::class, 'relatorioFinalizados']);
    Route::get('/painel/form-chamado', [ChamadosController::class, 'create']);
    Route::post('/painel/cria-chamado/store', [ChamadosController::class, 'store']);
    Route::get('/painel/interacao/chamado/{id}', [ChamadosController::class, 'update']);
    Route::post('/painel/inter-chamado-anexo/', [ChamadosController::class, 'update']);
    Route::get('/painel/chamado/encerra/{id}', [ChamadosController::class, 'destroy']);
    Route::get('/painel/atende-chamado/{id}', [ChamadosController::class, 'edit']);
    Route::get('/painel/update-chamado/{id}', [ChamadosController::class, 'updatechamado']);
    Route::get('/painel/create-interacao/{id}', [ChamadosController::class, 'show']);
    Route::get('/painel/lista-chamados-dpto', [ChamadosController::class, 'chamadosDpto']);
    Route::get('/painel/gera-pdf-descricao/{id}', [ChamadosController::class, 'pdfDescricao']);

    // Rotas Agenda
    Route::get('painel/agenda',[AgendaController::class,'index']);
    Route::get('painel/create',[AgendaController::class,'store']);
    Route::get('painel/agenda-demanda',[AgendaController::class,'create']);
    Route::get('painel/agenda/excluir',[AgendaController::class,'destroy']);

    // Send E-mails
    Route::get('/email/form-email', [SendEmailController::class, 'index']);
    Route::get('/email/send-email/store', [SendEmailController::class, 'send']);

    // AJAX CONTROLLER
    Route::get('get-funcao-pesquisa', [AjaxController::class, 'getFuncao']);
    Route::get('get-funcao-pesquisa', [AjaxController::class, 'getFuncao']);

    // Rotas de Relatórios
    Route::get('painel/relatorio-demandas', [ChamadosController::class, 'geraPDF']);
    Route::get('painel/graficos-demandas', [ChamadosController::class, 'geraGraficos']);
    Route::get('painel/demandas-setores', [ChamadosController::class, 'relatorios']);
});
