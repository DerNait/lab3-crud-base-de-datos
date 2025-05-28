<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PeliculaPersona;

class PeliculaPersonasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records = [];
        $roles = ['Director', 'Actor', 'Actor'];
        $personaId = 1;

        for ($peliculaId = 1; $peliculaId <= 30; $peliculaId++) {
            foreach ($roles as $rol) {
                $records[] = [
                    'pelicula_id' => $peliculaId,
                    'persona_id'  => $personaId,
                    'rol'         => $rol,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];
                $personaId = $personaId % 30 + 1;
            }
        }

        PeliculaPersona::truncate();
        PeliculaPersona::insert($records);
    }
}
