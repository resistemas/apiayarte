<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("favoritos")->insert([
            "cliente_id" => 6,
            "producto_id" => 4,
        ]);

        DB::table("favoritos")->insert([
            "cliente_id" => 6,
            "producto_id" => 2,
        ]);

        DB::table("favoritos")->insert([
            "cliente_id" => 5,
            "producto_id" => 1,
        ]);

        DB::table("favoritos")->insert([
            "cliente_id" => 4,
            "producto_id" => 3,
        ]);
    }
}
