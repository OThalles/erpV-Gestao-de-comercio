<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VendasController;
use App\Http\Controllers\ContasController;
use Illuminate\Support\Facades\Route;


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

Route::get('/', [DashboardController::class, 'home'])->name('main')->middleware('auth');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/signin', [LoginController::class, 'signin'])->name('signin');

Route::post('/auth', [LoginController::class, 'auth'])->name('auth.user');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::prefix('products')->group(function() {
    Route::get('/add-product', [StockController::class, 'newproduct'])->name('addproduct')->middleware('auth');
    Route::get('/add-stock', [StockController::class, 'newstock'])->middleware('auth');
    Route::get('/', [ProdutosController::class, 'products'])->name('products')->middleware('auth');
    Route::get('/edit-product/{id?}', [ProdutosController::class, 'editProduct'])->name('edit-product')->middleware('auth');
    Route::get('/delete-product/{id?}', [ProdutosController::class, 'deleteProduct'])->middleware('auth');
    Route::get('/edit-products', [ProdutosController::class, 'editAction'])->name('edit.action')->middleware('auth');
    Route::post('/add-product', [StockController::class, 'addProduct'])->name('addProduct');
});

//Actions

Route::get('/add-stock/{identification_number}/{quantity}', [StockController::class, 'addStock']);


Route::get('/product/{id?}', [ProdutosController::class, 'foundProducts'])->name('found-products')->middleware('auth');

Route::get('/log', [LogController::class, 'home'])->name('log-screen');

Route::get('/vendas', [VendasController::class, 'home']);

Route::POST('/finalize-sale', [VendasController::class, 'finalizeSale'])->name('new-sale');
Route::post('/insertprodutosvendidos', [VendasController::class, 'insertSoldProduct'])->middleware('auth');
Route::get('/nova-venda', [ProdutosController::class, 'home'])->middleware('auth');
Route::get('/detalhes-venda/{id?}', [VendasController::class, 'detalhesvenda'])->name('detalhesvenda')->middleware('auth');

Route::post('/new-log', [LogController::class, 'newLog'])->middleware('auth');

Route::get('/contas', [ContasController::class, 'home'])->name('invoice')->middleware('auth');
Route::get('/contas/delete/{id?}', [ContasController::class, 'delete'])->name('deleteinvoice')->middleware('auth');
Route::get('/contas/editstatus/{id?}/{status?}', [ContasController::class, 'edit'])->name('editstatus')->middleware('auth');
Route::get('/contas/add', [ContasController::class, 'add'])->name('addInvoiceScreen')->middleware('auth');
Route::post('/contas/add/action', [ContasController::class, 'addAction'])->name('addInvoice')->middleware('auth');

Route::prefix('dashboard')->group(function() {
    Route::get('/get-best-sellers', [DashboardController::class, 'getBestSellers'])->middleware('auth');
    Route::get('/get-last-days', [DashboardController::class, 'lastDaysVendas'])->middleware('auth');

});
