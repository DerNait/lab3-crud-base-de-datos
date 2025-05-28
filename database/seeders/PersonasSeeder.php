<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Persona;

class PersonasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nombres = [
            'Lucas Fernández','María Gómez','Ana Torres','Diego Ramírez','Camila Herrera','Mateo Vargas','Valentina Cruz','Santiago Ponce','Jimena Reyes','Gabriel Rivas',
            'Paula Salazar','Carlos Méndez','Lucía Delgado','Jorge Molina','Irene Castillo','Esteban Duarte','Cecilia Paredes','Alonso Vidal','Patricia Conde','Ricardo Serrano',
            'Daniela Ayala','Tomás Cortés','Sofía Barrios','Emilio Palacios','Julia Andrade','Martín Solís','Isabela Figueroa','Andrés Quintana','Fernanda Bravo','Pablo Cárdenas'
        ];

        $personas = array_map(fn($nombre) => ['nombre' => $nombre], $nombres);

        Persona::truncate();
        Persona::insert($personas);
    }
}
