<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('productos')->insert([
            'usuario_id' => 1,
            'categoria_id' => 2,
            'codigo' => "AYARTE-001",
            'producto' => "Árbol de la vida chico",
            'descripcion' => "Es una pieza de cerámica que representa un árbol con flora y fauna proveedora de vida. Hecho de arcilla y pinturas no tóxicas.",
            'photo_video' => "https://i.postimg.cc/Mnn4qJn4/pa-1-arbol-vida-chico.jpg",
            'precio' => 35.00
        ]);

        DB::table('productos')->insert([
            'usuario_id' => 1,
            'categoria_id' => 2,
            'codigo' => "AYARTE-002",
            'producto' => "Árbol de la vida",
            'descripcion' => "Es una pieza de cerámica que representa un árbol con flora y fauna proveedora de vida. Hecho de arcilla y pinturas no tóxicas.",
            'photo_video' => "https://i.postimg.cc/FYw6KCcK/pa-1-arbol-vida.jpg",
            'precio' => 55.00
        ]);

        DB::table('productos')->insert([
            'usuario_id' => 1,
            'categoria_id' => 1,
            'codigo' => "AYARTE-003",
            'producto' => "Armonía Floral",
            'descripcion' => "Camino de mesa con bordado de flores rojas y aplicación de crochet al borde.",
            'photo_video' => "https://i.postimg.cc/rKnbBwwx/pa-armonia-floral.jpg",
            'precio' => 320.00
        ]);

        DB::table('productos')->insert([
            'usuario_id' => 1,
            'categoria_id' => 2,
            'codigo' => "AYARTE-004",
            'producto' => "Bobo mensajero",
            'descripcion' => "Corazón mensajero floreado.",
            'photo_video' => "https://i.postimg.cc/F7s8CLNh/pa-bombo-masajero.jpg",
            'precio' => 10.00
        ]);

        DB::table('productos')->insert([
            'usuario_id' => 1,
            'categoria_id' => 1,
            'codigo' => "AYARTE-005",
            'producto' => "Bolso Chacana",
            'descripcion' => "Bolso con bordado y decoraciones de chacana.",
            "photo_video" => "https://i.postimg.cc/0rChCfgt/pa-bolso-chacana.jpg",
            'precio' => 44.00
        ]);
    }
}
