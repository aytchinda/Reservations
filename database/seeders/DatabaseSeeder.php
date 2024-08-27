<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\ArtistSeeder;
use Database\Seeders\ArtistTypeSeeder;
use Database\Seeders\ArtistTypeShowSeeder;
use Database\Seeders\LocalitySeeder;
use Database\Seeders\LocationSeeder;
use Database\Seeders\RepresentationSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\ShowSeeder;
use Database\Seeders\TypeSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            ArtistSeeder::class,
            UserSeeder::class,
            TypeSeeder::class,
            LocalitySeeder::class,
            RoleSeeder::class,
            LocationSeeder::class,
            RepresentationSeeder::class,
            ShowSeeder::class,
            ArtistTypeSeeder::class,
            ArtistTypeShowSeeder::class,
            RoleUserSeeder::class,  // Ajoutez cette ligne




        ]);

    }
}
