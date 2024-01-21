<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Filme;
use Illuminate\Http\Request;

class FilmeController extends Controller
{
    /**
     * Controller do CRUD de filmes usando Inertia
     */

    public function index()
    {
        // Lista de filmes
        $filmes = Filme::all();

        // Retorna a view com a lista de filmes
        return Inertia::render('Admin/Filmes/Index', [
            'filmes' => $filmes
        ]);
    }

    public function create()
    {
        // Retorna a view com o formulário de criação de filme
        return Inertia::render('Admin/Filmes/Create');
    }

    public function store(Request $request)
    {
        // Valida os dados do formulário
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif'
        ]);

        // Salva a imagem na pasta public/images
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        // Cria um novo filme
        Filme::create([
            'name' => $request->name,
            'image' => $imageName
        ]);

        // Retorna para a lista de filmes
        return redirect()->route('filmes.index');
    }

    public function show(Filme $filme)
    {
        // Retorna a view com os dados do filme
        return Inertia::render('Admin/Filmes/Show', [
            'filme' => $filme
        ]);
    }

    public function edit(Filme $filme)
    {
        // Retorna a view com o formulário de edição de filme
        return Inertia::render('Admin/Filmes/Edit', [
            'filme' => $filme
        ]);
    }

    public function update(Request $request, Filme $filme)
    {
        // Valida os dados do formulário
        $request->validate([
            'image' => 'image|mimes:jpeg,jpg,png,gif'
        ]);

        // Salva a imagem na pasta public/images
        if ($request->image) {
            // Deleta a imagem antiga
            unlink(public_path('images/' . $filme->image));

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        // Atualiza os dados do filme
        $filme->update([
            'name' => $request->name,
            'image' => $request->image ? $imageName : $filme->image
        ]);

        // Retorna para a lista de filmes
        return redirect()->route('filmes.index');
    }

    public function destroy(Filme $filme)
    {
        // Deleta o filme
        $filme->delete();

        // Retorna para a lista de filmes
        return redirect()->route('filmes.index');
    }
}
