@extends('home.homepage')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Détails du Spectacle</h1>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Informations sur la Réservation</h5>
                    @if(isset($user))
                        <p class="card-text"><strong>Utilisateur:</strong> {{ $user->firstname }} {{ $user->lastname }}</p>
                    @endif
                    <p class="card-text"><strong>Représentation:</strong> {{ $representation->when }}</p>
                </div>
            </div>
        </div>

        @if ($representation->show)
        <div class="col-lg-6">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Détails du Spectacle</h5>
                    <div class="text-center mb-3">
                        <img src="{{ asset('images/' . $representation->show->poster_url) }}" alt="{{ $representation->show->title }}" class="img-fluid rounded">
                    </div>
                    <p><strong>Titre :</strong> {{ $representation->show->title }}</p>
                    <p><strong>Description :</strong> {{ $representation->show->description }}</p>
                    <p><strong>Lieu :</strong> {{ $representation->show->location->name ?? 'Lieu non disponible' }}</p>
                    <p><strong>Adresse :</strong> {{ $representation->show->location->address ?? 'Adresse non disponible' }}</p>
                    <p><strong>Prix :</strong> {{ $representation->show->price }} €</p>
                    <p><strong>Réservable :</strong> {{ $representation->show->bookable ? 'Oui' : 'Non' }}</p>
                </div>
            </div>
        </div>
        @else
        <div class="col-lg-6">
            <div class="alert alert-warning">
                Détails du spectacle non disponibles.
            </div>
        </div>
        @endif
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('reservation.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Retour à la liste
        </a>
    </div>
</div>
@endsection
