<?php

use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(["auth"])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    });
    Route::get('/users', function () {
        return view('admin.users.list');
    });

    // Nuevas rutas
    Route::post('/producto/{id}/actualizar-stock', [ProductoController::class, 'actualizarProductos'])->name('actualizar-stock');

    // admin/categoria
    Route::resource('/categoria', CategoriaController::class);
    Route::resource('/producto', ProductoController::class);
    Route::resource('/cliente', ClienteController::class);
    Route::resource('/pedido', PedidoController::class);
    Route::resource('/proveedor', ProveedorController::class);
});
