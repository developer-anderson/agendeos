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
use App\Http\Controllers\UploadController;
Route::get('/agendamento/{slug}', [OrdemServicosController::class, 'getEstabelecimento'])->name('getEstabelecimentoWeb');

Route::permanentRedirect('/', 'https://site.agendos.com.br/');
Route::get('/pedido_pagamento/{os}', [OrdemServicosController::class, 'pedidoPagamento']);

Route::post('/cadastrar', [App\Http\Controllers\RegisterController::class, 'store'])->name('cadastrarWeb');
Route::post('/reset-password-token', [App\Http\Controllers\PasswordResetController::class, 'sendResetLinkEmail'])->name('token_recuperar_SenhaWeb');
Route::post('/password/reset', [App\Http\Controllers\PasswordResetController::class, 'resetPassword'])->name('password.reset.form');
Route::post('/retorno_pagamento', [App\Http\Controllers\OrdemServicosController::class, 'retornoPagamento'])->name('retornoPagamento');

Route::post('/reset-password', [App\Http\Controllers\PasswordResetController::class, 'resetPassword'])->name('trocar_senhaWeb');
Route::post('logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logoutWeb');
Route::get('/politica-de-privacidade', function () {
    return view('politica-privacidade');
});
