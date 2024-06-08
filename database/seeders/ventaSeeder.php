<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ventaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("ventas")->insert([
            "artesano_id" => 2,
            "cliente_id" => 4,
            "codigo" => Str::upper(Str::random(10)),
            "ciudad" => "AYACUCHO - HUAMANGA",
            "direccion" => "Jr Libertad N° 1545",
        ]);

        DB::table("ventas")->insert([
            "artesano_id" => 3,
            "cliente_id" => 5,
            "codigo" => Str::upper(Str::random(10)),
            "ciudad" => "LIMA",
            "direccion" => "Jr Cuzco N° 1545",
        ]);

        DB::table("ventas")->insert([
            "artesano_id" => 2,
            "cliente_id" => 5,
            "codigo" => Str::upper(Str::random(10)),
            "ciudad" => "HUANTA",
            "direccion" => "Jr Paracas N° 1545",
        ]);

        DB::table("ventas")->insert([
            "artesano_id" => 2,
            "cliente_id" => 6,
            "codigo" => Str::upper(Str::random(10)),
            "ciudad" => "AYACUCHO - SAN JUAN BAUTISTA",
            "direccion" => "Jr Miraflores N° 1545",
        ]);
    }
}
