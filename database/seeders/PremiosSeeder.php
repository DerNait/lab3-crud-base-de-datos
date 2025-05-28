<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Premio;

class PremiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nombres = [
            'Oscar','Golden Globe','BAFTA','Cannes Palm','Venice Lion',
            'Sundance Jury','Toronto People\'s Choice','Goya','César','Ariel',
            'Grammy Movie Score','Critics Choice','Saturn Award','Spirit Award','Annie Award'
        ];

        $premios = array_map(fn($nombre) => ['nombre' => $nombre], $nombres);

        Premio::truncate();
        Premio::insert($premios);
    }
}
