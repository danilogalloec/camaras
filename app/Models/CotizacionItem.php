<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionItem extends Model
{
    use HasFactory;

    // 👇 Fuerza el nombre correcto de la tabla
    protected $table = 'cotizacion_items';

    protected $fillable = [
        'cotizacion_id','item','cantidad','precio','descuento','total'
    ];

    public function cotizacion(){
        return $this->belongsTo(Cotizacion::class);
    }
}
