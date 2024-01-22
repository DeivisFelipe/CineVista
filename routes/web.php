<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmeController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\UsuarioController;

// Rota para o painel administrativo
Route::middleware('auth')->get('/', function () {
    return Inertia::render('Admin/Dashboard'); // Painel administrativo	s
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileAdminController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileAdminController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileAdminController::class, 'destroy'])->name('profile.destroy');

    // Crud Cinemas
    Route::get('/cinemas', [CinemaController::class, 'index'])->name('cinemas.index');
    Route::get('/cinemas/create', [CinemaController::class, 'create'])->name('cinemas.create');
    Route::post('/cinemas', [CinemaController::class, 'store'])->name('cinemas.store');
    Route::get('/cinemas/{cinema}/edit', [CinemaController::class, 'edit'])->name('cinemas.edit');
    Route::put('/cinemas/{cinema}', [CinemaController::class, 'update'])->name('cinemas.update');
    Route::delete('/cinemas/{cinema}', [CinemaController::class, 'destroy'])->name('cinemas.destroy');

    // Crud Filmes
    Route::get('/filmes', [FilmeController::class, 'index'])->name('filmes.index');
    Route::get('/filmes/create', [FilmeController::class, 'create'])->name('filmes.create');
    Route::post('/filmes', [FilmeController::class, 'store'])->name('filmes.store');
    Route::get('/filmes/{filme}/edit', [FilmeController::class, 'edit'])->name('filmes.edit');
    Route::post('/filmes/{filme}', [FilmeController::class, 'update'])->name('filmes.update');
    Route::delete('/filmes/{filme}', [FilmeController::class, 'destroy'])->name('filmes.destroy');

    // Crud Usuarios
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/{usuario}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{usuario}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{usuario}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
});

require __DIR__ . '/auth.php';
