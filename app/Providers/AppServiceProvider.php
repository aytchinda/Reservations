<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Reservation; // Import du modèle Reservation
use App\Policies\ReservationPolicy; // Import de la politique ReservationPolicy
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Enregistrement des politiques d'accès
        Gate::policy(Reservation::class, ReservationPolicy::class);

        // Exemple de définition de Gate pour d'autres actions
        Gate::define('create-artist', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('update-artist', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('delete-artist', function (User $user) {
            return $user->role === 'admin';
        });
    }
}
