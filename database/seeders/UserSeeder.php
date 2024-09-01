<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('role_user')->truncate();
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $users = [
            [
                'login' => 'bob',
                'firstname' => 'Bob',
                'lastname' => 'Sull',
                'email' => 'bob@sull.com',
                'password' => Hash::make('12345678'),
                'langue' => 'fr',
            ],
            [
                'login' => 'anna',
                'firstname' => 'Anna',
                'lastname' => 'Lyse',
                'email' => 'anna.lyse@sull.com',
                'password' => Hash::make('12345678'),
                'langue' => 'en',
            ],
            [
                'login' => 'john',
                'firstname' => 'John',
                'lastname' => 'Doe',
                'email' => 'john.doe@example.com',
                'password' => Hash::make('12345678'),
                'langue' => 'en',
            ],
            [
                'login' => 'alice',
                'firstname' => 'Alice',
                'lastname' => 'Wonderland',
                'email' => 'alice@wonderland.com',
                'password' => Hash::make('alice123'),
                'langue' => 'en',
            ],
            [
                'login' => 'charlie',
                'firstname' => 'Charlie',
                'lastname' => 'Chaplin',
                'email' => 'charlie@chaplin.com',
                'password' => Hash::make('charlie123'),
                'langue' => 'fr',
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
