<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("categorias")->insert([
            "categoria" => "Textiles Tradicionales",
            "estado" => "Activo"
        ]);

        DB::table("categorias")->insert([
            "categoria" => "Cerámica - Alfarería",
            "estado" => "Activo"
        ]);

        DB::table("categorias")->insert([
            "categoria" => "Joyeria - Bisuteria",
            "estado" => "Activo"
        ]);

        DB::table("categorias")->insert([
            "categoria" => "Tallado en Piedra - Madera",
            "estado" => "Activo"
        ]);

        DB::table("categorias")->insert([
            "categoria" => "Arte Religioso - Tradicional",
            "estado" => "Activo"
        ]);
    }
}
