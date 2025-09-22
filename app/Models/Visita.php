<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'fecha_visita',
        'comentario',
        'atendida',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
