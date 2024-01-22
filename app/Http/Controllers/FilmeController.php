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
            'nome' => 'required',
            'imagem' => 'required|image|mimes:jpeg,jpg,png,gif'
        ]);

        // Salva a imagem no public/storage/images/filmes
        $imageName = time() . '.' . $request->imagem->extension();
        $request->imagem->move(public_path('storage/images/filmes'), $imageName);


        // Cria um novo filme
        Filme::create([
            'nome' => $request->nome,
            'imagem' => $imageName
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
        // Se a imagem for igual a anterior, não valida e não salva
        if ($request->imagem != $filme->imagem) {
            // Valida os dados do formulário
            $request->validate([
                'imagem' => 'image|mimes:jpeg,jpg,png,gif'
            ]);

            // Salva a imagem na pasta public/images
            if ($request->imagem) {
                // Deleta a imagem antiga
                unlink(public_path('storage/images/filmes/' . $filme->imagem));

                $imageName = time() . '.' . $request->imagem->extension();
                $request->imagem->move(public_path('storage/images/filmes'), $imageName);
            }

            // Atualiza os dados do filme
            $filme->update([
                'name' => $request->nome,
                'imagem' => $request->imagem ? $imageName : $filme->imagem
            ]);
        } else {
            $filme->update([
                'name' => $request->nome,
            ]);
        }

        // Retorna para a lista de filmes
        return redirect()->route('filmes.index');
    }

    public function destroy(Filme $filme)
    {
        // Deleta a imagem
        unlink(public_path('storage/images/filmes/' . $filme->imagem));

        // Deleta o filme
        $filme->delete();

        // Retorna para a lista de filmes
        return redirect()->route('filmes.index');
    }
}
