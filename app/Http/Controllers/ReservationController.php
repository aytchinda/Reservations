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

        $reservations = Reservation::with('representation.show')->get();

        // dd($reservations); // Utilisez cette ligne pour déboguer

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

        $reservation = Reservation::create($validated);

        return redirect()->route('reservation.index', $reservation->id)->with('success', 'Reservation booked successfully.');
    }




    public function show(Reservation $reservation)
    {
        $this->authorize('view', $reservation);
        $reservation->load('representation.show');
        return view('reservation.show', compact('reservation'));
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
