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
            'usuario_id' => 2,
            'categoria_id' => 2,
            'codigo' => "AYARTE-001",
            'producto' => "Árbol de la vida chico",
            'descripcion' => "Es una pieza de cerámica que representa un árbol con flora y fauna proveedora de vida. Hecho de arcilla y pinturas no tóxicas.",
            'photo_video' => "https://i.postimg.cc/Mnn4qJn4/pa-1-arbol-vida-chico.jpg",
            'precio' => 35.00
        ]);

        DB::table('productos')->insert([
            'usuario_id' => 2,
            'categoria_id' => 2,
            'codigo' => "AYARTE-002",
            'producto' => "Árbol de la vida",
            'descripcion' => "Es una pieza de cerámica que representa un árbol con flora y fauna proveedora de vida. Hecho de arcilla y pinturas no tóxicas.",
            'photo_video' => "https://i.postimg.cc/FYw6KCcK/pa-1-arbol-vida.jpg",
            'precio' => 55.00
        ]);

        DB::table('productos')->insert([
            'usuario_id' => 3,
            'categoria_id' => 1,
            'codigo' => "AYARTE-003",
            'producto' => "Armonía Floral",
            'descripcion' => "Camino de mesa con bordado de flores rojas y aplicación de crochet al borde.",
            'photo_video' => "https://i.postimg.cc/rKnbBwwx/pa-armonia-floral.jpg",
            'precio' => 320.00
        ]);

        DB::table('productos')->insert([
            'usuario_id' => 3,
            'categoria_id' => 2,
            'codigo' => "AYARTE-004",
            'producto' => "Bobo mensajero",
            'descripcion' => "Corazón mensajero floreado.",
            'photo_video' => "https://i.postimg.cc/F7s8CLNh/pa-bombo-masajero.jpg",
            'precio' => 10.00
        ]);

        DB::table('productos')->insert([
            'usuario_id' => 2,
            'categoria_id' => 1,
            'codigo' => "AYARTE-005",
            'producto' => "Bolso Chacana",
            'descripcion' => "Bolso con bordado y decoraciones de chacana.",
            "photo_video" => "https://i.postimg.cc/0rChCfgt/pa-bolso-chacana.jpg",
            'precio' => 44.00
        ]);

        DB::table('productos')->insert([
            'usuario_id' => 2,
            'categoria_id' => 1,
            'codigo' => "AYARTE-006",
            'producto' => "Manto Tejido",
            'descripcion' => "Manto de tejido a callhua, sirve como decorativo en la pared, mesa o piso, diseño andino.",
            'photo_video' => "https://i.postimg.cc/wBy1VvF3/m1.jpg",
            'precio' => 35.00
        ]);

        DB::table('productos')->insert([
            'usuario_id' => 3,
            'categoria_id' => 1,
            'codigo' => "AYARTE-007",
            'producto' => "Tejido en Telar  – Diseño Tocapu Inka ",
            'descripcion' => "Este telar está hecho con lana de alpaca y algodón de alta calidad y tiene colores vivos y formas geométricas que representan la cosmovisión andina.",
            'photo_video' => "https://i.postimg.cc/B6bMN2kH/m2.jpg",
            'precio' => 1000.00
        ]);

        DB::table('productos')->insert([
            'usuario_id' => 2,
            'categoria_id' => 1,
            'codigo' => "AYARTE-008",
            'producto' => " Bolso Romina",
            'descripcion' => "El bolso tiene un tamaño perfecto para llevar tus cosas esenciales, y un cierre de cremallera para mayor seguridad.",
            'photo_video' => "https://i.postimg.cc/ZYFx37C2/3.jpg",
            'precio' => 180.00
        ]);

        DB::table('productos')->insert([
            'usuario_id' => 2,
            'categoria_id' => 1,
            'codigo' => "AYARTE-009",
            'producto' => "Bolso Romina",
            'descripcion' => "El diseño paracas es una expresión artística de la cultura preincaica que habitó la costa sur del Perú, y se caracteriza por sus formas geométricas y zoomorfas.",
            'photo_video' => "https://i.postimg.cc/jj9QR2Mr/m4.jpg",
            'precio' => 300.00
        ]);

        DB::table('productos')->insert([
            'usuario_id' => 3,
            'categoria_id' => 1,
            'codigo' => "AYARTE-010",
            'producto' => "Centro de Mesa – Raquis",
            'descripcion' => "Te presentamos este centro de mesa tejido y bordado a mano con lana de ovino y alpaca, que mide 1.60 x 0.30 m y tiene un diseño original en tonos amarillos y verdes.",
            'photo_video' => "https://i.postimg.cc/zf5Y0DC8/m5.jpg",
            'precio' => 230.00
        ]);

        DB::table('productos')->insert([
            'usuario_id' => 2,
            'categoria_id' => 1,
            'codigo' => "AYARTE-011",
            'producto' => "Cartera Sayri",
            'descripcion' => "Esta cartera tiene un color rosa vibrante que combina con cualquier atuendo, y está adornada con un delicado bordado de flores que le da un toque romántico y femenino.",
            'photo_video' => "https://i.postimg.cc/XN9hD6vv/m6.jpg",
            'precio' => 80.00
        ]);

        DB::table('productos')->insert([
            'usuario_id' => 3,
            'categoria_id' => 1,
            'codigo' => "AYARTE-012",
            'producto' => "Gallito De Las Rocas",
            'descripcion' => "Este modelo tiene la forma de una flor, con pétalos que se despliegan para revelar las figuras talladas y pintadas a mano con gran detalle y expresividad.",
            'photo_video' => "https://i.postimg.cc/3wdrgxYN/m7.jpg",
            'precio' => 70.00
        ]);

        DB::table('productos')->insert([
            'usuario_id' => 2,
            'categoria_id' => 1,
            'codigo' => "AYARTE-013",
            'producto' => " Cartera Waricono",
            'descripcion' => "Cartera representativa de la cultura Wari, con toques iconográficos ancestrales.",
            'photo_video' => "https://i.postimg.cc/Hn773tmJ/m8.jpg",
            'precio' => 75.00
        ]);

        DB::table('productos')->insert([
            'usuario_id' => 2,
            'categoria_id' => 1,
            'codigo' => "AYARTE-014",
            'producto' => " Cartera Waricono",
            'descripcion' => "Gorra abrigable para temporada de frío, modelo unisex",
            'photo_video' => "https://i.postimg.cc/k5B8BCHF/m9.jpg",
            'precio' => 20.00
        ]);

    }
}
