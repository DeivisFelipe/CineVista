<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingresso extends Model
{
    use HasFactory;

    protected $fillable = [
        'assento_id',
        'sessao_id',
        'cliente_id',
    ];

    protected $table = 'ingressos';

    public function assento()
    {
        return $this->belongsTo(Assento::class);
    }

    public function sessao()
    {
        return $this->belongsTo(Sessao::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
