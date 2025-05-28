<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE TYPE role_type AS ENUM ('Director', 'Actor', 'Productor', 'Guionista')");

        Schema::create('pelicula_personas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelicula_id')->constrained('peliculas')->onDelete('cascade');
            $table->foreignId('persona_id')->constrained('personas')->onDelete('cascade');
            $table->string('rol', 50);
            $table->timestamps();
            $table->unique(['pelicula_id', 'persona_id', 'rol']);
        });

        DB::statement("ALTER TABLE pelicula_personas ALTER COLUMN rol TYPE role_type USING rol::role_type");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP TYPE IF EXISTS role_type");
        Schema::dropIfExists('pelicula_personas');
    }
};
