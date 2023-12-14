<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\PlanosController;
use App\Http\Controllers\SegmentoController;
use App\Http\Controllers\FuncionariosController;
use App\Http\Controllers\VeiculosController;
use App\Http\Controllers\ServicosController;
use App\Http\Controllers\OrdemServicosController;
use App\Http\Controllers\FluxoCaixaController;
use App\Http\Controllers\AgendamentoController;
Route::get('agendamento/getEstabelecimento/{slug}', [OrdemServicosController::class, 'getEstabelecimento'])->name('getEstabelecimento');

Route::permanentRedirect('/', 'https://site.agendos.com.br/');


Route::get('clientes/getall{id}/{filter?}', [ClientesController::class, 'getall']);

Route::get('clientes/getAllclientByType/{type}/{id}/{filter?}', [ClientesController::class, 'getAllclientByType']);
Route::get('clientes/show/{id}', [ClientesController::class, 'exibirCliente'])->name('exibirCliente');
Route::post('clientes/insert', [ClientesController::class, 'store']);
Route::put('clientes/update/{id}',[ClientesController::class, 'update']);
Route::delete('clientes/destroy{clientes}', [ClientesController::class, 'destroy']);

Route::get('empresas/getall/{filter?}', [EmpresasController::class, 'getall']);
Route::get('empresas/show/{empresas}', [EmpresasController::class, 'show']);
Route::post('empresas/insert', [EmpresasController::class, 'store']);
Route::put('empresas/update/{empresas}',[EmpresasController::class, 'update']);
Route::delete('empresas/destroy{empresas}', [EmpresasController::class, 'destroy']);



Route::get('segmento/getall/{filter?}', [SegmentoController::class, 'getall']);
Route::get('segmento/show/{segmento}', [SegmentoController::class, 'show']);

Route::get('planos/getall/{filter?}', [PlanosController::class, 'getall']);
Route::get('planos/show/{planos}', [PlanosController::class, 'show']);

Route::get('funcionarios/getall/{id}/{filter?}', [FuncionariosController::class, 'getall']);

Route::get('funcionarios/show/{funcionario}', [FuncionariosController::class, 'show']);
Route::post('funcionarios/insert', [FuncionariosController::class, 'store']);
Route::put('funcionarios/update/{funcionario}',[FuncionariosController::class, 'update']);
Route::delete('funcionarios/destroy{funcionario}', [FuncionariosController::class, 'destroy']);

Route::get('os/getall/{id}/{inicio}/{fim?}/{filter?}', [OrdemServicosController::class, 'getall']);
Route::get('relatorio/{id}/{inicio?}/{fim?}', [OrdemServicosController::class, 'relatorio']);
Route::get('/cron', [OrdemServicosController::class, 'cron']);
Route::get('os/pdf/{id}/{os}', [OrdemServicosController::class, 'pdf']);
Route::get('os/show/{os}', [OrdemServicosController::class, 'show']);
Route::get('os/getServicosOs/{os}', [OrdemServicosController::class, 'getServicosOs']);
Route::post('os/insert', [OrdemServicosController::class, 'store']);
Route::put('os/update/{os}',[OrdemServicosController::class, 'update']);
Route::delete('os/destroy{os}', [OrdemServicosController::class, 'destroy']);

Route::get('/politica-de-privacidade', function () {
    return view('politica-privacidade');
});

Route::get('fluxo_caixa/getall/{id}/{inicio}/{fim}/{filter?}', [FluxoCaixaController::class, 'getall']);
Route::get('fluxo_caixa/show/{fluxo_caixa}', [FluxoCaixaController::class, 'show']);
Route::post('fluxo_caixa/insert', [FluxoCaixaController::class, 'store']);
Route::put('fluxo_caixa/update/{fluxo_caixa}',[FluxoCaixaController::class, 'update']);
Route::delete('fluxo_caixa/destroy{fluxo_caixa}', [FluxoCaixaController::class, 'destroy']);

Route::get('veiculos/getall/{id}/{filter?}', [VeiculosController::class, 'getall']);
Route::get('veiculos/cliente/{id}', [VeiculosController::class, 'getallCliente']);
Route::get('veiculos/show/{veiculos}', [VeiculosController::class, 'show']);
Route::post('veiculos/insert', [VeiculosController::class, 'store']);
Route::put('veiculos/update/{veiculos}',[VeiculosController::class, 'update']);
Route::delete('veiculos/destroy{veiculos}', [VeiculosController::class, 'destroy']);

Route::get('servicos/getall/{id}/{filter?}', [ServicosController::class, 'getall']);
Route::get('servicos/show/{servicos}', [ServicosController::class, 'show']);
Route::get('servicos/terminoPrevisao/{horario}/{servicos}', [ServicosController::class, 'terminoPrevisao']);
Route::post('servicos/insert', [ServicosController::class, 'store']);
Route::put('servicos/update/{servicos}',[ServicosController::class, 'update']);
Route::delete('servicos/destroy{servicos}', [ServicosController::class, 'destroy']);

Route::put('usuario/update/{usuario}',[UsuariosController::class, 'atualizarPerfil'])->name('atualizarPerfil');

Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('/cadastrar', [App\Http\Controllers\RegisterController::class, 'store'])->name('cadastrar');
Route::post('/reset-password-token', [App\Http\Controllers\PasswordResetController::class, 'sendResetLinkEmail'])->name('token_recuperar_Senha');
Route::post('/password/reset', [App\Http\Controllers\PasswordResetController::class, 'resetPassword'])->name('password.reset.resetPassword');

Route::post('/reset-password', [App\Http\Controllers\PasswordResetController::class, 'resetPassword'])->name('trocar_senha');
Route::post('logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');


Route::get('/agendamentos/{id}/{filter?}', [AgendamentoController::class, 'getAll']);
Route::post('/agendamentos/agenda_funcionario/{id}/{funcionario_id}/{data}', [AgendamentoController::class, 'getHorariosDisponiveis']);
Route::post('/agendamentos/{agendamentoId}/adicionar-itens', [AgendamentoController::class, 'adicionarItens']);
Route::post('/agendamentos', [AgendamentoController::class, 'store']);
Route::get('/agendamentos/buscar/{id}/{agendamento?}', [AgendamentoController::class, 'show']);
Route::put('/agendamentos/{agendamento}/{situacao_id}', [AgendamentoController::class, 'updateStatusAgendamento']);
Route::put('/agendamentos/{id}', [AgendamentoController::class, 'update']);
Route::delete('/agendamentos/{agendamento}', [AgendamentoController::class, 'destroy']);
