<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PeliculaPremio;

class PeliculaPremiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records = [];
        $premioIdCounter = 0;

        for ($peliculaId = 1; $peliculaId <= 30; $peliculaId++) {
            $premiosUsados = [];

            for ($i = 0; $i < 3; $i++) {
                do {
                    $premioIdCounter = ($premioIdCounter % 15) + 1;
                } while (in_array($premioIdCounter, $premiosUsados));

                $premiosUsados[] = $premioIdCounter;

                $records[] = [
                    'pelicula_id' => $peliculaId,
                    'premio_id'   => $premioIdCounter,
                    'año'         => 2000 + $premioIdCounter,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];
            }
        }

        PeliculaPremio::truncate();
        PeliculaPremio::insert($records);
    }
}
