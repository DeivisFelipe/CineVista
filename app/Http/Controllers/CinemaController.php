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
        $cinemas = Tenant::with('domains')->get();

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
            'nome' => 'required|unique:tenants,nome',
            'domain' => 'required|unique:domains,domain'
        ]);

        // Gera o ID do cinema que é o nome sem espaços e em minúsculo
        $id = strtolower(str_replace(' ', '', $request->nome));

        // Cria um novo cinema
        $tenant = Tenant::create([
            'id' => $id,
            'nome' => $request->nome,
        ]);

        // Cria um novo domínio para o cinema
        $tenant->domains()->create([
            'domain' => $request->domain,
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
        $cinema->load('domains');

        // Retorna a view com o formulário de edição de cinema
        return Inertia::render('Admin/Cinemas/Edit', [
            'cinema' => $cinema
        ]);
    }

    public function update(Request $request, Tenant $cinema)
    {
        // Valida os dados do formulário
        $request->validate([
            'name' => 'unique:tenants,name,' . $cinema->id,
            'domain' => 'unique:domains,domain,' . $cinema->domains[0]->id
        ]);

        // Atualiza os dados do cinema
        $cinema->update([
            'name' => $request->name,
        ]);

        // Atualiza os dados do domínio
        $cinema->domains()->update([
            'domain' => $request->domain,
        ]);

        // Retorna para a lista de cinemas
        return redirect()->route('cinemas.index');
    }

    public function destroy(Tenant $cinema)
    {
        // Deleta os domínios do cinema
        $cinema->domains()->delete();

        // Deleta o cinema
        $cinema->delete();

        // Retorna para a lista de cinemas
        return redirect()->route('cinemas.index');
    }
}
