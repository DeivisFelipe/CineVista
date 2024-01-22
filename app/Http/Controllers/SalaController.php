<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Inertia\Inertia;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    /**
     * Controller para gerenciar as salas
     */

    public function salas()
    {
        $salas = Sala::all();
        return Inertia::render(
            'Cinema/Usuario/Salas/Index',
            [
                'salas' => $salas
            ]
        );
    }

    public function createSala()
    {
        return Inertia::render('Cinema/Usuario/Salas/Create');
    }

    public function storeSala(Request $request)
    {
        // Valida os dados
        $request->validate([
            'numero' => 'required|numeric|unique:salas,numero',
        ]);

        // Cria a sala
        Sala::create([
            'numero' => $request->numero,
        ]);

        return redirect()->route('cinema.usuario.salas');
    }

    public function editSala(Sala $sala)
    {
        return Inertia::render('Cinema/Usuario/Salas/Edit', [
            'sala' => $sala
        ]);
    }

    public function updateSala(Request $request, Sala $sala)
    {
        // Valida os dados
        $request->validate([
            'numero' => 'required|numeric|unique:salas,numero,' . $sala->id . ',id',
        ]);

        // Atualiza a sala
        $sala->update([
            'numero' => $request->numero,
        ]);

        return redirect()->route('cinema.usuario.salas');
    }

    public function destroySala(Sala $sala)
    {
        $sala->delete();
        return redirect()->route('cinema.usuario.salas');
    }

    public function assentos(Sala $sala)
    {
        $assentos = $sala->assentos;
        return Inertia::render('Cinema/Usuario/Salas/Assentos/Index', [
            'assentos' => $assentos,
            'sala' => $sala
        ]);
    }
}
