<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
    ];

    protected $table = 'salas';

    public function assentos()
    {
        return $this->hasMany(Assento::class);
    }

    public function sessoes()
    {
        return $this->hasMany(Sessao::class);
    }
}
