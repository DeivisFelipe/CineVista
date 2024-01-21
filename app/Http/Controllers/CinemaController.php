<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CinemaController extends Controller
{
    /** 
     * Controller do CRUD de cinemas usando Inertia
     */

    public function index()
    {
        // Lista de cinemas
        $cinemas = Tenant::all();

        // Retorna a view com a lista de cinemas
        return Inertia::render('Admin/Cinemas/Index', [
            'cinemas' => $cinemas
        ]);
    }

    public function create()
    {
        // Retorna a view com o formulário de criação de cinema
        return Inertia::render('Admin/Cinemas/Create');
    }

    public function store(Request $request)
    {
        // Valida os dados do formulário
        $request->validate([
            'name' => 'required',
        ]);

        // Cria um novo cinema
        Tenant::create([
            'name' => $request->name,
        ]);

        // Retorna para a lista de cinemas
        return redirect()->route('cinemas.index');
    }

    public function show(Tenant $cinema)
    {
        // Retorna a view com os dados do cinema
        return Inertia::render('Admin/Cinemas/Show', [
            'cinema' => $cinema
        ]);
    }

    public function edit(Tenant $cinema)
    {
        // Retorna a view com o formulário de edição de cinema
        return Inertia::render('Admin/Cinemas/Edit', [
            'cinema' => $cinema
        ]);
    }

    public function update(Request $request, Tenant $cinema)
    {
        // Atualiza os dados do cinema
        $cinema->update([
            'name' => $request->name,
        ]);

        // Retorna para a lista de cinemas
        return redirect()->route('cinemas.index');
    }
}
