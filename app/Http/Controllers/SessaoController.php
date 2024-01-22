<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Inertia\Inertia;
use App\Models\Filme;
use App\Models\Sessao;
use Illuminate\Http\Request;

class SessaoController extends Controller
{
    /**
     * Controller para gerenciar as sessoes
     */

    public function sessoes()
    {
        $sessoes = Sessao::with('sala')->get();

        // Para casa sessao, pega o filme
        foreach ($sessoes as $sessao) {
            $sessao->filme = $sessao->filme();
        }

        return Inertia::render('Cinema/Usuario/Sessoes/Index', [
            'sessoes' => $sessoes
        ]);
    }

    public function createSessao()
    {
        return Inertia::render('Cinema/Usuario/Sessoes/Create');
    }

    public function storeSessao(Request $request)
    {
        // Valida os dados
        $request->validate([
            'filme_id' => 'required|numeric',
            'sala_id' => 'required|numeric|exists:salas,id',
            'inicio' => 'required|date',
            'fim' => 'required|date',
            'preco' => 'required|numeric',
        ]);

        // Cria a Sessao
        Sessao::create([
            'filme_id' => $request->filme_id,
            'sala_id' => $request->sala_id,
            'inicio' => $request->inicio,
            'fim' => $request->fim,
            'preco' => $request->preco,
        ]);

        return redirect()->route('cinema.usuario.sessoes');
    }

    public function destroySessao(Sessao $sessao)
    {
        $sessao->delete();
        return redirect()->route('cinema.usuario.sessoes');
    }

    public function searchFilmes(Request $request)
    {
        $filmes = [];
        tenancy()->central(function () use ($request, &$filmes) {
            $filmes = Filme::where('nome', 'like', '%' . $request->filme . '%')->get();
        });

        return response()->json($filmes);
    }

    // Search salas
    public function searchSalas(Request $request)
    {
        $salas = Sala::where('numero', 'like', '%' . $request->numero . '%')->get();

        return response()->json($salas);
    }
}
