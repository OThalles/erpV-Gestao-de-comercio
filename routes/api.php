<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\VendasController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StockController;

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

Route::get('/find-product/{identification_number}', [ProdutosController::class, 'findProduct']);

    Route::get('/findAllProducts', [ProdutosController::class, 'listAllProducts']);


Route::prefix('auth')->group(function(){
    Route::post('loginApi', [LoginController::class, 'loginApi']);
    Route::post('logoutApi', [LoginController::class, 'logout']);
    Route::post('registerApi', [RegisterController::class, 'registerApi']);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
