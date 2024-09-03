@extends('home.homepage')

@section('content')
<div class="container mt-5">

    <!-- Formulaire de recherche -->
    <h1 class="mb-4 text-center">Rechercher un Spectacle</h1>
    <form action="{{ route('home.search') }}" method="GET" class="mb-5">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="name">Nom du spectacle :</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Rechercher par nom...">
            </div>
            <div class="col-md-6 mb-3">
                <label for="date">Date :</label>
                <input type="date" id="date" name="date" class="form-control">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </form>

    <!-- Affichage des résultats de recherche -->
    @if(request()->has('name') || request()->has('date'))
        <h2 class="mb-4 text-center">Résultats de la recherche</h2>
        @if($shows->isNotEmpty())
            <div class="row">
                @foreach($shows as $show)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('images/' . $show->poster_url) }}" class="card-img-top" alt="{{ $show->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $show->title }}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($show->description, 100) }}</p>
                            <a href="{{ route('reservation.create', ['show_id' => $show->id]) }}" class="btn btn-primary">
                                Réserver
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <p class="text-center">Aucun spectacle trouvé pour cette recherche.</p>
        @endif
    @endif

    <!-- Liste des spectacles -->
    <h1 class="mb-4 text-center">Nos Spectacles</h1>
    <div class="row">
        @foreach($shows as $show)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <img src="{{ asset('images/' . $show->poster_url) }}" class="card-img-top" alt="{{ $show->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $show->title }}</h5>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit($show->description, 100) }}</p>
                    <a href="{{ route('reservation.create', ['show_id' => $show->id]) }}" class="btn btn-primary">
                        Réserver
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
