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

        DB::table("users")->insert([
            "rol_id" => 2,
            "codigo" => Str::upper(Str::random(10)),
            "nombresApellidos" => "ALDO QUISPE HUAMANTINCO",
            "correoElectronico" => "aldoquispe@gmail.com",
            "usuario" => "AldoQuispe",
            "password" => Hash::make("Admin123")
        ]);

        DB::table("users")->insert([
            "rol_id" => 2,
            "codigo" => Str::upper(Str::random(10)),
            "nombresApellidos" => "KATHERIN CAYLLAHUA CH.",
            "correoElectronico" => "katherin@gmail.com",
            "usuario" => "KatherinCay",
            "password" => Hash::make("Admin123")
        ]);

        DB::table("users")->insert([
            "rol_id" => 3,
            "codigo" => Str::upper(Str::random(10)),
            "nombresApellidos" => "LUIS ALBERTO DE LA CRUZ",
            "correoElectronico" => "luisalberto@gmail.com",
            "usuario" => "LuisAlberto",
            "password" => Hash::make("Admin123")
        ]);

        DB::table("users")->insert([
            "rol_id" => 3,
            "codigo" => Str::upper(Str::random(10)),
            "nombresApellidos" => "JOSE QUISPE AQUINO",
            "correoElectronico" => "    ",
            "usuario" => "Josefita",
            "password" => Hash::make("Admin123")
        ]);

        DB::table("users")->insert([
            "rol_id" => 3,
            "codigo" => Str::upper(Str::random(10)),
            "nombresApellidos" => "TAIS OSCORIMA CANCHARI",
            "correoElectronico" => "taisoscorima@gmail.com",
            "usuario" => "TaisOscorima",
            "password" => Hash::make("Admin123")
        ]);
    }
}
