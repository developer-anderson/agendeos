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
Route::get('/token', function (Request $request) {
    $token = $request->session()->token();
 
    return  response()->json(csrf_token());;
 
    // ...
});
Route::get('clientes/getall', [ClientesController::class, 'getall']);

Route::get('clientes/show{clientes}', [ClientesController::class, 'show']);
Route::post('clientes/insert', [ClientesController::class, 'store']);
Route::put('clientes/update',[ClientesController::class, 'update']);
Route::delete('clientes/destroy{clientes}', [ClientesController::class, 'destroy']);
