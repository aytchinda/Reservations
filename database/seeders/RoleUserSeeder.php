<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Désactiver temporairement les contraintes de clés étrangères
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('role_user')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $adminRole = Role::where('role', 'admin')->first();
        $memberRole = Role::where('role', 'member')->first();
        $affiliateRole = Role::where('role', 'affiliate')->first();
        $managerRole = Role::where('role', 'manager')->first();
        $supervisorRole = Role::where('role', 'supervisor')->first();

        // Debugging output

        // Récupérer les utilisateurs
        $bob = User::where('login', 'bob')->first();
        $anna = User::where('login', 'anna')->first();
        $john = User::where('login', 'john')->first();
        $alice = User::where('login', 'alice')->first();
        $charlie = User::where('login', 'charlie')->first();

        // Assigner les rôles aux utilisateurs
        if ($bob) {
            $bob->roles()->sync([$adminRole->id]);
        }

        if ($anna) {
            $anna->roles()->attach($memberRole);
        }
        if ($john) {
            $john->roles()->attach($affiliateRole);
        }
        if ($alice) {
            $alice->roles()->attach($managerRole);
        }
        if ($charlie) {
            $charlie->roles()->attach($supervisorRole);
        }
    }
}
