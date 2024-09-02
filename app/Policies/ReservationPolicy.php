<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reservation;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReservationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any reservations.
     */
    public function viewAny(User $user): bool
    {
        // Exemple de logique d'autorisation, vous pouvez la personnaliser
        return true;  // Autorise tous les utilisateurs à voir la liste des réservations
    }

    /**
     * Determine whether the user can view the reservation.
     */
    public function view(User $user, Reservation $reservation): bool
    {
        // Autoriser si l'utilisateur est propriétaire de la réservation ou s'il est admin
        return $user->id === $reservation->user_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can create reservations.
     */
    public function create(User $user): bool
    {
        return true; // Autorise tous les utilisateurs connectés à créer une réservation
    }

    /**
     * Determine whether the user can update the reservation.
     */
    public function update(User $user, Reservation $reservation): bool
    {
        // Autoriser si l'utilisateur est propriétaire de la réservation ou s'il est admin
        return $user->id === $reservation->user_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the reservation.
     */
    public function delete(User $user, Reservation $reservation): bool
    {
        // Autoriser si l'utilisateur est propriétaire de la réservation ou s'il est admin
        return $user->id === $reservation->user_id || $user->role === 'admin';
    }
}
