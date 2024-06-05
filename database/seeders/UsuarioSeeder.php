<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            "rol_id" => 1,
            "codigo" => Str::upper(Str::random(10)),
            "nombresApellidos" => "RONI SUMARI PALOMINO",
            "correoElectronico" => "resistemasinfo@gmail.com",
            "usuario" => "Administrador",
            "password" => Hash::make("Admin123")
        ]);
    }
}
