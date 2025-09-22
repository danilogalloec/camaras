<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    protected $table = 'cotizaciones';

    protected $fillable = [
        'numero_cotizacion','nombre','cedula','direccion','correo','celular',
        'validez_oferta','subtotal','impuesto','total','notas','condiciones'
    ];

    // ✅ Corregido: ahora es un número entero
    protected $casts = [
        'validez_oferta' => 'integer'
    ];

    public function items()
    {
        return $this->hasMany(CotizacionItem::class);
    }
}
