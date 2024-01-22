<?php

declare(strict_types=1);

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\AuthClienteController;
use App\Http\Controllers\AuthUsuarioController;
use App\Http\Controllers\ProfileCinemaController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\SessaoController;
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

    Route::middleware('auth:usuario')->group(function () {
        Route::get('cinema/usuario/profile', [ProfileCinemaController::class, 'edit'])->name('cinema.usuario.profile.edit');
        Route::patch('cinema/usuario/profile', [ProfileCinemaController::class, 'update'])->name('cinema.usuario.profile.update');
        Route::delete('cinema/usuario/profile', [ProfileCinemaController::class, 'destroy'])->name('cinema.usuario.sprofile.destroy');

        // Crud salas
        Route::get('cinema/usuario/salas', [SalaController::class, 'salas'])->name('cinema.usuario.salas');
        Route::get('cinema/usuario/salas/create', [SalaController::class, 'createSala'])->name('cinema.usuario.salas.create');
        Route::post('cinema/usuario/salas/create', [SalaController::class, 'storeSala'])->name('cinema.usuario.salas.store');
        Route::get('cinema/usuario/salas/{sala}/edit', [SalaController::class, 'editSala'])->name('cinema.usuario.salas.edit');
        Route::patch('cinema/usuario/salas/{sala}/edit', [SalaController::class, 'updateSala'])->name('cinema.usuario.salas.update');
        Route::delete('cinema/usuario/salas/{sala}/edit', [SalaController::class, 'destroySala'])->name('cinema.usuario.salas.destroy');

        // Crud Assentos
        Route::get('cinema/usuario/salas/{sala}/assentos', [SalaController::class, 'assentos'])->name('cinema.usuario.salas.assentos.index');
        Route::post('cinema/usuario/salas/{sala}/assentos/create', [SalaController::class, 'storeAssento'])->name('cinema.usuario.salas.assentos.store');
        Route::delete('cinema/usuario/salas/{sala}/assentos/{assento}/edit', [SalaController::class, 'destroyAssento'])->name('cinema.usuario.salas.assentos.destroy');

        // Crud Sessoes
        Route::get('cinema/usuario/sessoes', [SessaoController::class, 'sessoes'])->name('cinema.usuario.sessoes');
        Route::get('cinema/usuario/sessoes/create', [SessaoController::class, 'createSessao'])->name('cinema.usuario.sessoes.create');
        Route::post('cinema/usuario/sessoes/create', [SessaoController::class, 'storeSessao'])->name('cinema.usuario.sessoes.store');
        Route::get('cinema/usuario/sessoes/{sessao}/edit', [SessaoController::class, 'editSessao'])->name('cinema.usuario.sessoes.edit');
        Route::patch('cinema/usuario/sessoes/{sessao}/edit', [SessaoController::class, 'updateSessao'])->name('cinema.usuario.sessoes.update');
        Route::delete('cinema/usuario/sessoes/{sessao}/edit', [SessaoController::class, 'destroySessao'])->name('cinema.usuario.sessoes.destroy');
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
