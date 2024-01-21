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

    protected $table = 'sessoes';

    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }

    public function filme()
    {
        return $this->belongsTo(Filme::class);
    }

    public function ingressos()
    {
        return $this->hasMany(Ingresso::class);
    }
}
