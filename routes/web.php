<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\OrdemServicosController;
use App\Http\Controllers\ServicosController;
use App\Http\Controllers\VeiculosController;
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
    return view('welcome');
});
Route::get('clientes/getall', 'ClientesController@getAll');
Route::get('clientes/show{clientes}', 'ClientesController@show');
Route::post('clientes/store', 'ClientesController@store');
Route::put('clientes/update', 'ClientesController@update');
Route::delete('clientes/destroy{clientes}', 'ClientesController@destroy');