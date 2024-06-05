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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId("rol_id")->constrained("roles", "id");
            $table->string("codigo", 10);
            $table->string("nombresApellidos");
            $table->string("correoElectronico");
            $table->string("photo")->default("https://pixabay.com/vectors/user-icon-person-personal-about-me-2517433/");
            $table->string("usuario")->unique();
            $table->string("password");
            $table->timestamps();
            $table->enum("estado", ["Activo", "Suspendido", "Eliminado"])->default("Activo");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
