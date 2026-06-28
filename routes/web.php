<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;

Route::get('/', function () {
    return view('welcome');
});

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Auth Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Email Verification Routes
    Route::get('/email/verify', [VerificationController::class, 'notice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
        ->middleware('signed')
        ->name('verification.verify');
    Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // Protected Dashboard (Must be verified)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    // Clientes & Fornecedores CRM Management
    Route::middleware('verified')->group(function () {
        Route::resource('clientes', App\Http\Controllers\ClienteController::class)->except(['show']);
        Route::resource('fornecedores', App\Http\Controllers\FornecedorController::class)->except(['show']);
        Route::resource('produtos', App\Http\Controllers\ProdutoController::class)->except(['show']);

        // Auxiliares - Categorias & Unidades
        Route::resource('categorias', App\Http\Controllers\CategoriaController::class)->except(['create', 'show']);
        Route::resource('unidades', App\Http\Controllers\UnidadeController::class)->except(['create', 'show']);
    });
});
