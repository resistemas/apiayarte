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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId("usuario_id")->constrained("users", "id");
            $table->foreignId("categoria_id")->constrained("categorias", "id");
            $table->string("codigo")->unique();
            $table->string("producto");
            $table->text("descripcion")->nullable();
            $table->text("photo_video");
            $table->decimal("precio", 11, 2);
            $table->timestamps();
            $table->enum("estado", ["Activo", "Inactivo", "Eliminado"])->default("Activo");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
