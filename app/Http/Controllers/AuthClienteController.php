<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;

class AuthClienteController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Cinema/Cliente/Login');
    }

    /**
     * Função para fazer login
     */

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'cpf' => 'required',
            'password' => 'required',
        ]);

        // tenta fazer o login
        if (Auth::guard('cliente')->attempt($request->only('cpf', 'password'))) {

            $cliente = Cliente::where('cpf', $request->cpf)->first();

            // Faz o login do cliente
            Auth::guard('cliente')->login($cliente);

            return redirect()->route('home');
        }


        return back()->withErrors([
            'cpf' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('cliente')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Display the registration view.
     */
    public function registro(): Response
    {
        return Inertia::render('Cinema/Cliente/Registro');
    }

    /**
     * Handle an incoming registration request.
     */
    public function registrar(Request $request): RedirectResponse
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|unique:clientes,cpf',
            'password' => 'required|string|min:8',
        ]);

        // Cria o cliente
        $cliente = Cliente::create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'password' => bcrypt($request->password),
        ]);

        // Autentica o cliente
        Auth::guard('cliente')->login($cliente);

        return redirect()->route('home');
    }
}
