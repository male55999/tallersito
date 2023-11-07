<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PedidoController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('products', ProductController::class);
Route::resource('users', UserController::class);
Route::resource('orders', OrderController::class);
Route::resource('pedidos', PedidoController::class);


Route::post('agregar-pedido', [PedidoController::class,'agregarPedido']);
Route::get('emailsito', [PedidoController::class,'buscarPorEmail']);
Route::get('telefonsito', [PedidoController::class,'buscarPorCelular']);
Route::put('cambiarsito', [PedidoController::class,'updateEstado']);
