<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\IngredientController;

Route::get('/', function () {
    return view('welcome');
});

// Ruta para mostrar el formulario de login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Ruta para procesar el login (POST)
Route::post('/login', [AuthController::class, 'loginWeb']);

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register'); // Página de registro
Route::post('/register', [AuthController::class, 'registerWeb']); // Registro web

// Ruta para el dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {

    // Rutas de pedidos
    Route::get('/orders', [OrderController::class, 'indexWeb'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'showWeb'])->name('orders.showOrder');

    // Rutas de clientes
    Route::get('/clientes', [CustomerController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/create', [CustomerController::class, 'create'])->name('clientes.create');
    Route::post('/clientes', [CustomerController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/{customer}/edit', [CustomerController::class, 'edit'])->name('clientes.edit');
    Route::put('/clientes/{customer}', [CustomerController::class, 'update'])->name('clientes.update');
    Route::delete('/clientes/{customer}', [CustomerController::class, 'destroy'])->name('clientes.destroy');

    // Rutas de ingredientes
    Route::get('/ingredientes', [IngredientController::class, 'index'])->name('ingredientes.index');
    Route::get('/ingredientes/create', [IngredientController::class, 'create'])->name('ingredientes.create');
    Route::post('/ingredientes', [IngredientController::class, 'store'])->name('ingredientes.store');
    Route::get('/ingredientes/{ingredient}/edit', [IngredientController::class, 'edit'])->name('ingredientes.edit');
    Route::put('/ingredientes/{ingredient}', [IngredientController::class, 'update'])->name('ingredientes.update');
    Route::delete('/ingredientes/{ingredient}', [IngredientController::class, 'destroy'])->name('ingredientes.destroy');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    
});