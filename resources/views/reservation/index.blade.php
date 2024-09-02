@extends('home.homepage')

@section('content')
<div class="container">
    <h1>Liste des Réservations</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom de l'Utilisateur</th>
                <th>Représentation</th>
                <th>Nombre de Places</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->firstname }} {{ $reservation->lastname }}</td>
                    <td>
                        @if ($reservation->representation && $reservation->representation->show)
                            {{ $reservation->representation->show->title }} - {{ $reservation->representation->when }}
                        @else
                            Représentation non disponible
                        @endif
                    </td>
                    <td>{{ $reservation->seats }}</td>
                    <td>
                        <a href="{{ route('reservation.show', $reservation->id) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-primary">Modifier</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
