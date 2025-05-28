<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Model::unguard();
        Schema::disableForeignKeyConstraints();
        $this->call([
            PeliculasSeeder::class,
            PersonasSeeder::class,
            PremiosSeeder::class,
            PeliculaPersonasSeeder::class,
            PeliculaPremiosSeeder::class,
        ]);
        Schema::enableForeignKeyConstraints();
        Model::reguard();

        Cache::flush();
    }
}
