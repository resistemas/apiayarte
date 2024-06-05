<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId("venta_id")->constrained("ventas", "id");
            $table->foreignId("producto_id")->constrained("productos", "id");
            $table->integer("cantidad");
            $table->decimal("total");
            $table->timestamps();
            $table->enum("estado", ["Activo", "Inactivo"])->default("Activo");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
    }
};
