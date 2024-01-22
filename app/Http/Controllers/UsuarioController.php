<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Controller do CRUD de usuários usando Inertia
     */

    public function index()
    {
        // Lista de usuários
        $usuarios = User::all();

        // Retorna a view com a lista de usuários
        return Inertia::render('Admin/Usuarios/Index', [
            'usuarios' => $usuarios
        ]);
    }

    public function create()
    {
        // Retorna a view com o formulário de criação de usuário
        return Inertia::render('Admin/Usuarios/Create');
    }

    public function store(Request $request)
    {
        // Valida os dados do formulário
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'admin' => 'required'
        ]);

        // Cria um novo usuário
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'admin' => $request->admin == 'true' ? true : false
        ]);

        // Retorna para a lista de usuários
        return redirect()->route('usuarios.index');
    }

    public function show(User $usuario)
    {
        // Retorna a view com os dados do usuário
        return Inertia::render('Admin/Usuarios/Show', [
            'usuario' => $usuario
        ]);
    }

    public function edit(User $usuario)
    {
        // Retorna a view com o formulário de edição de usuário
        return Inertia::render('Admin/Usuarios/Edit', [
            'usuario' => $usuario
        ]);
    }

    public function update(Request $request, User $usuario)
    {
        // Valida os dados do formulário
        $request->validate([
            'name' => 'string',
            'email' => 'email|unique:users,email,' . $usuario->id,
        ]);

        // Atualiza o usuário
        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
            'admin' => $request->admin == 'true' ? true : false
        ]);

        // Retorna para a lista de usuários
        return redirect()->route('usuarios.index');
    }

    public function destroy(User $usuario)
    {
        // Verifica se o usuario atual é o mesmo que está sendo deletado
        if (auth()->user()->id == $usuario->id) {
            // Retorna mensagem de erro
            return back()->withErrors(['error' => 'Você não pode deletar o seu próprio usuário']);
        }
        // Deleta o usuário
        $usuario->delete();

        // Retorna para a lista de usuários
        return redirect()->route('usuarios.index');
    }

    public function find(Request $request)
    {
        // Valida os dados do formulário
        $request->validate([
            'email' => 'required'
        ]);

        // Busca o usuário pelo email com Like
        $usuarios = User::where('email', 'like', '%' . $request->email . '%')->limit(10)->get();

        return response()->json(['usuarios' => $usuarios]);
    }
}
