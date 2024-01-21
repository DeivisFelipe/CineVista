<?php

use App\Http\Controllers\Auth\AuthAdminController;
use Illuminate\Support\Facades\Route;

// Rotas de autenticação
Route::middleware('guest')->group(function () {
    // Só tem rota de login
    Route::get('login', [AuthAdminController::class, 'create']);

    Route::post('login', [AuthAdminController::class, 'store'])->name('login');
});

// Rota para logout
Route::middleware('auth')->group(function () {
    // Faz logout da pessoas
    Route::post('logout', [AuthAdminController::class, 'destroy'])
        ->name('logout');
});
