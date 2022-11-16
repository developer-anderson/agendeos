<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\OrdemServicosController;
use App\Http\Controllers\ServicosController;
use App\Http\Controllers\VeiculosController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,HEAD,PUT,POST,DELETE,PATCH,OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-Auth-Token, Origin, Authorization');
Route::options('/{any:.*}', [function (){ 
   return response(['status' => 'success']); 
  }
 ]
);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('clientes/getall', [ClientesController::class, 'getall']);
Route::get('clientes/viewToken', [ClientesController::class, 'viewToken']);
Route::get('clientes/show{clientes}', [ClientesController::class, 'show']);
Route::post('clientes/store', [ClientesController::class, 'store']);
Route::put('clientes/update',[ClientesController::class, 'update']);
Route::delete('clientes/destroy{clientes}', [ClientesController::class, 'destroy']);
