<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assento extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'fileira',
        'sala_id',
    ];

    protected $table = 'assentos';

    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }

    public function ingressos()
    {
        return $this->hasMany(Ingresso::class);
    }
}
