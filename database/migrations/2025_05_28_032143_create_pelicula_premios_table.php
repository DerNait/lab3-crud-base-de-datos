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
        Schema::create('pelicula_premios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelicula_id')->constrained('peliculas')->onDelete('cascade');
            $table->foreignId('premio_id')->constrained('premios')->onDelete('cascade');
            $table->integer('año')->check('año >= 1888 AND año <= EXTRACT(YEAR FROM CURRENT_DATE)');
            $table->timestamps();
            $table->unique(['pelicula_id', 'premio_id', 'año']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelicula_premios');
    }
};
