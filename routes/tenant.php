<?php

declare(strict_types=1);

// use Inertia\Inertia;
// use Illuminate\Support\Facades\Route;
// use Illuminate\Foundation\Application;
// use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\Auth\PasswordController;
// use App\Http\Controllers\Auth\NewPasswordController;
// use App\Http\Controllers\Auth\VerifyEmailController;
// use App\Http\Controllers\Auth\RegisteredUserController;
// use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
// use App\Http\Controllers\Auth\PasswordResetLinkController;
// use App\Http\Controllers\Auth\ConfirmablePasswordController;
// use App\Http\Controllers\Auth\AuthenticatedSessionController;
// use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
// use App\Http\Controllers\Auth\EmailVerificationPromptController;
// use App\Http\Controllers\Auth\EmailVerificationNotificationController;


// Route::middleware([
//     'web',
//     InitializeTenancyByDomain::class,
//     PreventAccessFromCentralDomains::class,
// ])->group(function () {
//     Route::get('/', function () {
//         return Inertia::render('Welcome', [
//             'canLogin' => Route::has('login'),
//             'canRegister' => Route::has('register'),
//             'laravelVersion' => Application::VERSION,
//             'phpVersion' => PHP_VERSION,
//         ]);
//     });

//     Route::get('/dashboard', function () {
//         return Inertia::render('Dashboard');
//     })->middleware(['auth', 'verified'])->name('dashboard');

//     Route::middleware('auth')->group(function () {
//         Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//         Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//         Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//     });

//     Route::middleware('guest')->group(function () {

//         // Rota que mostra a tela de login
//         Route::get('login', [AuthenticatedSessionController::class, 'create'])
//             ->name('login');

//         Route::post('login', [AuthenticatedSessionController::class, 'store']);
//     });

//     Route::middleware('auth')->group(function () {
//         Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
//             ->name('logout');
//     });
// });
