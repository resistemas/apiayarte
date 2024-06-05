<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            "rol" => "Administrador",
            "estado" => "Activo"
        ]);

        DB::table('roles')->insert([
            "rol" => "Artesano",
            "estado" => "Activo"
        ]);

        DB::table('roles')->insert([
            "rol" => "Cliente",
            "estado" => "Activo"
        ]);
    }
}
