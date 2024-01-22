<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessao extends Model
{
    use HasFactory;

    protected $fillable = [
        'inicio',
        'fim',
        'sala_id',
        'filme_id',
        'preco',
    ];

    protected $table = 'sessao';

    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }

    public function filme()
    {
        $filme = null;
        $sessao = $this;
        // Desativa o tenancy para pegar o filme
        tenancy()->central(function ()  use ($sessao, &$filme) {
            $filme = Filme::find($sessao->filme_id);
        });

        return $filme;
    }

    public function ingressos()
    {
        return $this->hasMany(Ingresso::class);
    }
}
