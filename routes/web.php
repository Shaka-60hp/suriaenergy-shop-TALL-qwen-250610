<?php

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\CheckoutController;
use App\Http\Controllers\Auth\RegisterController;


// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Catálogo
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/productos/mas-vendidos', [ProductController::class, 'topSelling'])->name('products.top-selling');
Route::get('/productos/ofertas', [ProductController::class, 'onSale'])->name('products.on-sale');
Route::get('/productos/nuevos', [ProductController::class, 'newProducts'])->name('products.new');

// Categorías
Route::get('/categories/{family:slug}', [ProductController::class, 'byFamily'])->name('products.by-family');

// Carrito
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');
});

// Rutas de Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Rutas de Registro
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Dentro del grupo autenticado (opcional, pero recomendado)
Route::get('/checkout', [CheckoutController::class, 'index'])->name('cart.checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success', function () {
    $order = session('order');
    return view('web.checkout.success', compact('order'));
})->name('checkout.success');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    // Ruta de logout
    Route::post('/logout', function () {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});
