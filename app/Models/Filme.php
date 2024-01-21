<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'imagem',
    ];

    protected $table = 'filmes';

    public function sessoes()
    {
        return $this->hasMany(Sessao::class);
    }
}
