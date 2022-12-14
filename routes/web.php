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
use App\Http\Controllers\VeiculosController;
use App\Http\Controllers\ServicosController;
use App\Http\Controllers\OrdemServicosController;
use App\Http\Controllers\FluxoCaixaController;
Route::get('/token', function (Request $request) {
    $token = $request->session()->token();
 
    return  response()->json(csrf_token());;
 
    // ...
});
Route::get('/', function () { return redirect('/login.html'); });
Route::get('ordem-de-servico.php', function () { return redirect('/ordem-de-servico.php'); });
Route::get('listar-receitas.php', function () { return redirect('/listar-receitas.php'); });
Route::get('clientes/getall{id}', [ClientesController::class, 'getall']);
Route::get('clientes/getAllclientByType/{type}/{id}', [ClientesController::class, 'getAllclientByType']);
Route::get('clientes/show/{clientes}', [ClientesController::class, 'show']);
Route::post('clientes/insert', [ClientesController::class, 'store']);
Route::put('clientes/update/{clientes}',[ClientesController::class, 'update']);
Route::delete('clientes/destroy{clientes}', [ClientesController::class, 'destroy']);

Route::get('os/getall/{id}/{inicio}/{fim}', [OrdemServicosController::class, 'getall']);
Route::get('os/pdf/{id}/{os}', [OrdemServicosController::class, 'pdf']);
Route::get('os/show/{os}', [OrdemServicosController::class, 'show']);
Route::get('os/getServicosOs/{os}', [OrdemServicosController::class, 'getServicosOs']);
Route::post('os/insert', [OrdemServicosController::class, 'store']);
Route::put('os/update/{os}',[OrdemServicosController::class, 'update']);
Route::delete('os/destroy{os}', [OrdemServicosController::class, 'destroy']);


Route::get('fluxo_caixa/getall/{id}/{inicio}/{fim}', [FluxoCaixaController::class, 'getall']);
Route::get('fluxo_caixa/show/{fluxo_caixa}', [FluxoCaixaController::class, 'show']);
Route::post('fluxo_caixa/insert', [FluxoCaixaController::class, 'store']);
Route::put('fluxo_caixa/update/{fluxo_caixa}',[FluxoCaixaController::class, 'update']);
Route::delete('fluxo_caixa/destroy{fluxo_caixa}', [FluxoCaixaController::class, 'destroy']);

Route::get('veiculos/getall/{id}', [VeiculosController::class, 'getall']);
Route::get('veiculos/cliente/{id}', [VeiculosController::class, 'getallCliente']);
Route::get('veiculos/show/{veiculos}', [VeiculosController::class, 'show']);
Route::post('veiculos/insert', [VeiculosController::class, 'store']);
Route::put('veiculos/update/{veiculos}',[VeiculosController::class, 'update']);
Route::delete('veiculos/destroy{veiculos}', [VeiculosController::class, 'destroy']);

Route::get('servicos/getall/{id}', [ServicosController::class, 'getall']);
Route::get('servicos/show/{servicos}', [ServicosController::class, 'show']);
Route::get('servicos/terminoPrevisao/{horario}/{servicos}', [ServicosController::class, 'terminoPrevisao']);
Route::post('servicos/insert', [ServicosController::class, 'store']);
Route::put('servicos/update/{servicos}',[ServicosController::class, 'update']);
Route::delete('servicos/destroy{servicos}', [ServicosController::class, 'destroy']);

Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::get('/register', [App\Http\Controllers\RegisterController::class, 'show'])->name('register');
Route::get('/reset-password', [App\Http\Controllers\ResetPassword::class, 'show'])->name('reset-password');
Route::post('logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');



