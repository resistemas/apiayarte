<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table  = "ventas";

    protected $fillable = [
        'artesano_id', 'cliente_id', 'codigo', 'ciudad', 'direccion', 'estado',
    ];

    public function artesano()
    {
        return $this->belongsTo(User::class, 'artesano_id');
    }

    public function clietne()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    
}
