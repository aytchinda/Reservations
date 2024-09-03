<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Representation;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ReservationController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Reservation::class);

        $user = auth()->user();
        $reservations = Reservation::with('representation.show')
                        ->where('user_id', $user->id) // Filtrer par utilisateur connecté
                        ->get();

        return view('reservation.index', compact('reservations'));
    }

    public function create()
    {
        // Charger toutes les représentations avec les shows associés
        $representations = Representation::with('show')->get();

        // Retourner la vue avec les représentations disponibles
        return view('reservation.create', compact('representations'));
    }

    public function book(Request $request)
    {
        $this->authorize('create', Reservation::class);

        $validated = $request->validate([
            'representation_id' => 'required|exists:representations,id',
            'seats' => 'required|integer|min:1',
        ]);

        $validated['user_id'] = auth()->user()->id;

        $representation = Representation::find($validated['representation_id']);
        $validated['show_id'] = $representation ? $representation->show_id : null;

        // Calculer le prix total
        $totalPrice = $representation->show->price * $validated['seats'];

        // Créer la réservation
        $reservation = Reservation::create($validated);

        // Afficher une vue avec un formulaire automatique pour soumettre les données à Stripe
        return view('payment.redirect_to_stripe', [
            'reservation_id' => $reservation->id,
            'show_title' => $representation->show->title,
            'total_price' => $totalPrice,
        ]);
    }


    public function show($id)
    {
        // Trouver la réservation associée
        $reservation = Reservation::with('representation.show')->findOrFail($id);

        // Charger l'utilisateur connecté (si nécessaire)
        $user = auth()->user();

        // Passer les données à la vue de détails
        return view('reservation.show', [
            'representation' => $reservation->representation,
            'user' => $user
        ]);
    }

    public function edit(Reservation $reservation)
    {
        $this->authorize('update', $reservation);
        $reservation->load('representation.show');
        return view('reservation.edit', compact('reservation'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $this->authorize('update', $reservation);

        $validated = $request->validate([
            'seats' => 'required|integer|min:1',
            'representation_id' => 'required|exists:representations,id',
        ]);

        if ($request->has('representation_id') && $request->representation_id != $reservation->representation_id) {
            $representation = Representation::find($request->representation_id);
            $validated['show_id'] = $representation ? $representation->show_id : null;
        }

        $reservation->update($validated);

        return redirect()->route('reservation.index', $reservation->id)->with('success', 'Reservation updated successfully.');
    }

    public function destroy(Reservation $reservation)
    {
        $this->authorize('delete', $reservation);

        $reservation->delete();

        return redirect()->route('reservation.index')->with('success', 'Reservation cancelled successfully.');
    }
}
