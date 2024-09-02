@extends('home.homepage')

@section('content')
<div class="container">
    <h1>Détails de la Réservation</h1>

    <div class="card">
        <div class="card-body">
            <p class="card-text"><strong>Nom de l'Utilisateur:</strong> {{ $reservation->firstname }} {{ $reservation->lastname }}</p>
            <p class="card-text"><strong>Représentation:</strong>
                @if ($reservation->representation && $reservation->representation->show)
                    {{ $reservation->representation->show->title }} - {{ $reservation->representation->when }}
                @else
                    Représentation non disponible
                @endif
            </p>
            <p class="card-text"><strong>Nombre de Places:</strong> {{ $reservation->seats }}</p>
            <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-primary">Modifier</a>
        </div>
    </div>

    <a href="{{ route('reservation.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
</div>
@endsection
