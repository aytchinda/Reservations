@extends('home.homepage')

@section('content')
<div class="container">
    <h1>Modifier la Réservation</h1>

    <form method="POST" action="{{ route('reservation.update', $reservation->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="seats">Nombre de Places</label>
            <input type="number" name="seats" id="seats" class="form-control" value="{{ old('seats', $reservation->seats) }}" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Enregistrer les Modifications</button>
        <a href="{{ route('reservation.index') }}" class="btn btn-secondary mt-3">Annuler</a>
    </form>
</div>
@endsection
