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
        DB::statement("CREATE TYPE rating_type AS ENUM ('G', 'PG', 'PG-13', 'R', 'NC-17')");
        DB::statement("CREATE TYPE genre_type AS ENUM ('Accion', 'Comedia', 'Drama', 'Terror', 'Ciencia Ficcion', 'Romance', 'Documental', 'Animacion', 'Fantasia')");

        Schema::create('peliculas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 100);
            $table->text('sinopsis')->nullable();
            $table->date('fecha_estreno');
            $table->integer('duracion')->check('duracion > 0');
            $table->integer('presupuesto')->check('presupuesto >= 0');
            $table->timestamps();
            $table->unique(['titulo', 'fecha_estreno']);
        });

        DB::statement("ALTER TABLE peliculas ADD genero genre_type NOT NULL");
        DB::statement("ALTER TABLE peliculas ADD clasificacion rating_type NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peliculas');
        DB::statement("DROP TYPE IF EXISTS rating_type");
        DB::statement("DROP TYPE IF EXISTS genre_type");
    }
};
