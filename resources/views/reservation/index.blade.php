@extends('home.homepage')

@section('content')
<div class="container">
    <h1>Liste des Réservations</h1>

    <a href="{{ route('reservation.create') }}" class="btn btn-primary mb-3">Faire une Réservation</a>

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
                    <td>{{ $reservation->user->firstname }} {{ $reservation->user->lastname }}</td>
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
                        <form action="{{ route('reservation.destroy', $reservation->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');">
                                Annuler
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
