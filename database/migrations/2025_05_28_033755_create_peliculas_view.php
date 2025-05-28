<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        DB::statement("DROP VIEW IF EXISTS v_peliculas");

        DB::statement(<<<SQL
        CREATE VIEW v_peliculas AS
        SELECT p.id, p.titulo, p.sinopsis, p.fecha_estreno, p.duracion, p.presupuesto, p.genero, p.clasificacion,
            STRING_AGG(DISTINCT CASE WHEN pp.rol = 'Director' THEN per.nombre END, ', ') AS directores,
            STRING_AGG(DISTINCT CASE WHEN pp.rol = 'Actor' THEN per.nombre END, ', ') AS actores,
            STRING_AGG(DISTINCT pr.nombre || ' (' || pprem.año || ')', ', ') AS premios
        FROM peliculas p
        LEFT JOIN pelicula_personas pp ON pp.pelicula_id = p.id
        LEFT JOIN personas per ON per.id = pp.persona_id
        LEFT JOIN pelicula_premios pprem ON pprem.pelicula_id = p.id
        LEFT JOIN premios pr ON pr.id = pprem.premio_id
        GROUP BY p.id
        SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS v_peliculas");
    }
};
