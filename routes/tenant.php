<?php

declare(strict_types=1);

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\AuthClienteController;
use App\Http\Controllers\AuthUsuarioController;
use App\Http\Controllers\ProfileCinemaController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;


Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        $cliente = Auth::guard('cliente')->user();

        return Inertia::render('Cinema/Cliente/Index', [
            'cliente' => $cliente
        ]);
    })->name('home');

    Route::get('/dashboard', function () {
        return Inertia::render('Cinema/Usuario/Dashboard');
    })->middleware(['auth:usuario'])->name('cinema.usuario.dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileCinemaController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileCinemaController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileCinemaController::class, 'destroy'])->name('profile.destroy');
    });

    Route::middleware('guest')->group(function () {
        // Rota que mostra a tela de login do usuário   
        Route::get('login/usuario', [AuthUsuarioController::class, 'create'])
            ->name('cinema.usuario.login');
        // Rota que faz o login do usuário
        Route::post('login/usuario', [AuthUsuarioController::class, 'store'])
            ->name('cinema.usuario.logging');

        // Rota que mostra a tela de login do cliente
        Route::get('login/cliente', [AuthClienteController::class, 'create'])
            ->name('cinema.cliente.login');
        // Rota que faz o login do cliente
        Route::post('login/cliente', [AuthClienteController::class, 'store'])
            ->name('cinema.cliente.logging');

        // Rota que mostra a tela de registro do cliente
        Route::get('register/cliente', [AuthClienteController::class, 'registro'])
            ->name('cinema.cliente.register');
        // Rota que faz o registro do cliente
        Route::post('register/cliente', [AuthClienteController::class, 'registrar'])
            ->name('cinema.cliente.registering');
    });

    Route::middleware('auth:cliente')->group(function () {
        // Rota de logout do cliente
        Route::post('logout/cliente', [AuthClienteController::class, 'destroy'])
            ->name('cinema.cliente.logout');
    });

    Route::middleware('auth:usuario')->group(function () {
        // Rota de logout do usuário
        Route::post('logout/usuario', [AuthUsuarioController::class, 'destroy'])
            ->name('cinema.usuario.logout');
    });
});
