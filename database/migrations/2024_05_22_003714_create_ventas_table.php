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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId("artesano_id")->constrained("users", "id");
            $table->foreignId("cliente_id")->constrained("users", "id");
            $table->string("codigo", 8);
            $table->string("ciudad");
            $table->text("direccion");
            $table->timestamps();
            $table->enum("estado", ["Iniciado", "Completado", "Cancelado"])->default("Iniciado");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
