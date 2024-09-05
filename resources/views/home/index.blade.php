@extends('home.homepage')

@section('content')
    <div class="container mt-5">

       <!-- Formulaire de recherche -->
<h2 class="mb-3 text-center">Rechercher un Spectacle</h2>
<form action="{{ route('home.search') }}" method="GET" class="mb-4">
    <div class="row justify-content-center">
        <div class="col-md-3 mb-2">
            <label for="name">Nom du spectacle :</label>
            <input type="text" id="name" name="name" class="form-control form-control-sm"
                placeholder="Nom du spectacle...">
        </div>
        <div class="col-md-3 mb-2">
            <label for="date">Date :</label>
            <input type="date" id="date" name="date" class="form-control form-control-sm">
        </div>
        <div class="col-md-2 mb-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
        </div>
    </div>
</form>

        <!-- Liste des spectacles -->
        <h1 class="mb-4 text-center">Nos Spectacles</h1>
        <div class="row">
            @foreach ($shows as $show)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('images/' . $show->poster_url) }}" class="card-img-top"
                            alt="{{ $show->title }}">
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
