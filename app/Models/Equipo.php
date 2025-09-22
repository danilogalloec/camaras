<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    /**
     * Los campos que se pueden asignar de forma masiva.
     */
    protected $fillable = [
        'cliente_id',
        'tipo',
        'marca',
        'modelo',
        'numero_serie',      // ✅ nombre correcto en la BD
        'fecha_instalacion',
        'garantia_meses',
        'observaciones',
    ];

    /**
     * Relaciones
     * Cada equipo pertenece a un cliente.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
