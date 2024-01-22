<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthUsuarioController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Cinema/Usuario/Login');
    }

    /**
     * Função para fazer login
     */

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Pega o tenant atual
        $tenant = tenant();

        // Pega o usuário pelo email
        $user = $tenant->users()->where('email', $request->email)->first();

        // Verifica se o usuário existe no tenant
        if ($user) {
            tenancy()->central(function () use ($request, $user) {
                // Verifica se as credenciais estão corretas
                Auth::guard('usuario')->attempt($request->only('email', 'password'));
            });


            if (Auth::guard('usuario')->check()) {
                // Redireciona para o painel administrativo
                return redirect()->route('cinema.usuario.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
