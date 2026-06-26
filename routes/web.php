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

    // Clientes CRM Management
    Route::middleware('verified')->group(function () {
        Route::get('/clientes', [App\Http\Controllers\ClienteController::class, 'index'])->name('clientes.index');
        Route::get('/clientes/create', [App\Http\Controllers\ClienteController::class, 'create'])->name('clientes.create');
        Route::post('/clientes', [App\Http\Controllers\ClienteController::class, 'store'])->name('clientes.store');

        // Fornecedores Management
        Route::get('/fornecedores', [App\Http\Controllers\FornecedorController::class, 'index'])->name('fornecedores.index');
        Route::get('/fornecedores/create', [App\Http\Controllers\FornecedorController::class, 'create'])->name('fornecedores.create');
        Route::post('/fornecedores', [App\Http\Controllers\FornecedorController::class, 'store'])->name('fornecedores.store');
    });
});
