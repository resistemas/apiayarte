<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table  = "detalle_ventas";

    protected $fillable = [
        'id', 'venta_id', 'producto_id', 'cantidad', 'total', 'estado',
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
        // return $this->belongsToMany(DetalleVenta::class, 'productos','id','id',null,'producto_id','productos');
    }
}
