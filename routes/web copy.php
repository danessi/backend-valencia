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

// Vista para listar los pedidos (dashboard/admin)
Route::middleware('auth')->get('/orders', [OrderController::class, 'indexWeb'])->name('orders.index');
Route::middleware('auth')->get('/orders/create', [OrderController::class, 'create'])->name('orders.create');

Route::middleware('auth')->post('/orders', [OrderController::class, 'store'])->name('orders.store');

// Vista para ver el detalle de un pedido específico
Route::middleware('auth')->get('/orders/{order}', [OrderController::class, 'showWeb'])->name('orders.showOrder');


// Mostrar lista de clientes
Route::middleware('auth')->get('/clientes', [CustomerController::class, 'index'])->name('clientes.index');

// Mostrar formulario de creación de cliente
Route::middleware('auth')->get('/clientes/create', [CustomerController::class, 'create'])->name('clientes.create');

// Almacenar nuevo cliente
Route::middleware('auth')->post('/clientes', [CustomerController::class, 'store'])->name('clientes.store');

// Mostrar formulario de edición de cliente
Route::middleware('auth')->get('/clientes/{customer}/edit', [CustomerController::class, 'edit'])->name('clientes.edit');

// Actualizar cliente
Route::middleware('auth')->put('/clientes/{customer}', [CustomerController::class, 'update'])->name('clientes.update');

// Eliminar cliente
Route::middleware('auth')->delete('/clientes/{customer}', [CustomerController::class, 'destroy'])->name('clientes.destroy');


// Mostrar lista de ingredientes
Route::middleware('auth')->get('/ingredientes', [IngredientController::class, 'index'])->name('ingredientes.index');

// Mostrar formulario de creación de ingrediente
Route::middleware('auth')->get('/ingredientes/create', [IngredientController::class, 'create'])->name('ingredientes.create');

// Almacenar nuevo ingrediente
Route::middleware('auth')->post('/ingredientes', [IngredientController::class, 'store'])->name('ingredientes.store');

// Mostrar formulario de edición de ingrediente
Route::middleware('auth')->get('/ingredientes/{ingredient}/edit', [IngredientController::class, 'edit'])->name('ingredientes.edit');

// Actualizar ingrediente
Route::middleware('auth')->put('/ingredientes/{ingredient}', [IngredientController::class, 'update'])->name('ingredientes.update');

// Eliminar ingrediente
Route::middleware('auth')->delete('/ingredientes/{ingredient}', [IngredientController::class, 'destroy'])->name('ingredientes.destroy');


Route::middleware('auth')->get('/clientes', [CustomerController::class, 'index'])->name('clientes.index');
Route::middleware('auth')->get('/clientes/create', [CustomerController::class, 'create'])->name('clientes.create');
Route::middleware('auth')->post('/clientes', [CustomerController::class, 'store'])->name('clientes.store');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

