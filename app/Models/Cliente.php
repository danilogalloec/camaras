<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Cliente extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'cedula',
        'nombre',
        'telefono',
        'correo',
        'direccion',
        'fecha_instalacion',
        'num_equipos',
        'tiempo_garantia_meses',
        'password',
        'primer_login',
    ];

    protected $hidden = ['password'];

    // === Relaciones ===
    public function visitas()
    {
        return $this->hasMany(Visita::class);
    }

    public function equipos()
    {
        // un cliente tiene muchos equipos
        return $this->hasMany(Equipo::class);
    }
}
