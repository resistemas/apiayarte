<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table  = "productos";

    protected $fillable = [
        'usuario_id', 'categoria_id', 'codigo', 'producto', 'descripcion', 'photo_video', 'precio', 'created_ad', 'estado',
    ];

    public function vendedor()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
