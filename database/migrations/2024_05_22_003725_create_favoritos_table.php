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
        Schema::create('favoritos', function (Blueprint $table) {
            $table->id();
            $table->foreignId("cliente_id")->constrained("users", "id");
            $table->foreignId("producto_id")->constrained("productos", "id");
            $table->timestamps();
            $table->enum("estado", ["Activo", "Inactivo", "Eliminado"])->default("Activo");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favoritos');
    }
};
