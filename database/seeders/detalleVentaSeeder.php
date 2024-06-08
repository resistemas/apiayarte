<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class detalleVentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("detalle_ventas")->insert([
            "venta_id" => 1,
            "producto_id" => 2,
            "cantidad" => 1,
            "total" => 55.00,
        ]);

        DB::table("detalle_ventas")->insert([
            "venta_id" => 2,
            "producto_id" => 2,
            "cantidad" => 1,
            "total" => 55.00,
        ]);

        DB::table("detalle_ventas")->insert([
            "venta_id" => 3,
            "producto_id" => 4,
            "cantidad" => 1,
            "total" => 55.00,
        ]);

        DB::table("detalle_ventas")->insert([
            "venta_id" => 4,
            "producto_id" => 1,
            "cantidad" => 1,
            "total" => 55.00,
        ]);
    }
}
