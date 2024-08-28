<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Representation;

class UserRepresentationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer tous les utilisateurs et toutes les représentations
        $users = User::all();
        $representations = Representation::all();

        // Vérifier s'il y a des utilisateurs et des représentations
        if ($users->isEmpty() || $representations->isEmpty()) {
            return;
        }

        // Pour chaque utilisateur, associer de manière aléatoire des représentations
        foreach ($users as $user) {
            // Associer un nombre aléatoire de représentations à chaque utilisateur
            $user->representations()->attach(
                $representations->random(rand(1, 3))->pluck('id')->toArray()
            );
        }
    }
}
