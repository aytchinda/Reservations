<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Representation;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ReservationController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the reservations.
     */
    public function index()
    {
        $this->authorize('viewAny', Reservation::class);

        // Charger les relations 'representation' et 'show'
        $reservations = Reservation::with('representation.show')->get();

        return view('reservation.index', compact('reservations'));
    }

    /**
     * Display the specified reservation.
     */
    public function show(Reservation $reservation)
    {
        $this->authorize('view', $reservation);

        // Charger la relation 'representation' et 'show'
        $reservation->load('representation.show');

        return view('reservation.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified reservation.
     */
    public function edit(Reservation $reservation)
    {
        $this->authorize('update', $reservation);

        // Charger la relation 'representation' et 'show'
        $reservation->load('representation.show');

        return view('reservation.edit', compact('reservation'));
    }

    /**
     * Update the specified reservation in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $this->authorize('update', $reservation);

        // Validation des données d'entrée
        $validated = $request->validate([
            'seats' => 'required|integer|min:1',
        ]);

        // Si la représentation change, mettre à jour le show_id
        if ($request->has('representation_id') && $request->representation_id != $reservation->representation_id) {
            $representation = Representation::find($request->representation_id);
            $validated['show_id'] = $representation ? $representation->show_id : null;
        }

        // Mise à jour de la réservation avec les données validées
        $reservation->update($validated);

        // Redirection vers la vue de la réservation avec un message de succès
        return redirect()->route('reservation.show', $reservation)->with('success', 'Reservation updated successfully.');
    }

    /**
     * Book a new reservation.
     */
    public function book(Request $request)
    {
        $this->authorize('create', Reservation::class);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'representation_id' => 'required|exists:representations,id',
            'seats' => 'required|integer|min:1',
        ]);

        $representation = Representation::find($validated['representation_id']);

        // Ajouter show_id aux données validées
        $validated['show_id'] = $representation ? $representation->show_id : null;

        $reservation = Reservation::create($validated);

        return redirect()->route('reservation.show', $reservation)->with('success', 'Reservation booked successfully.');
    }
}
