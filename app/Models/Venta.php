<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table  = "ventas";

    protected $fillable = [
        'id', 'artesano_id', 'cliente_id', 'codigo', 'ciudad', 'direccion', 'estado'
    ];

    public function artesano()
    {
        return $this->belongsTo(User::class, 'artesano_id');
    }

    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function detalle()
    {
        return $this->belongsTo(DetalleVenta::class, 'id', 'venta_id', 'ventas');
    }


}
