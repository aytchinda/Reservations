<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Representation;
use App\Models\Reservation;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Données de test explicites
        $testData = [
            [
                'user_email' => 'bob@sull.com',
                'representation_id' => 1,
                'seats' => 2,
            ],
            [
                'user_email' => 'anna.lyse@sull.com',
                'representation_id' => 2,
                'seats' => 3,
            ],
        ];

        foreach ($testData as $data) {
            $user = User::where('email', $data['user_email'])->first();
            $representation = Representation::find($data['representation_id']);

            if ($user && $representation) {
                Reservation::create([
                    'user_id' => $user->id,
                    'representation_id' => $representation->id,
                    'show_id' => $representation->show_id, // Associer show_id à la réservation
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'seats' => $data['seats'],
                ]);
            }
        }
    }
}
