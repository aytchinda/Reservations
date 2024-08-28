@extends('home.homepage')

@section('title', 'Fiche d\'un artiste')

@section('content')
    <article class="text-center" style="margin: 0 auto; max-width: 800px;">
        <h1>{{ $artist->firstname }} {{ $artist->lastname }}</h1>

        @if ($artist->photo_url)
            <p><img src="{{ asset('images/' . $artist->photo_url) }}" alt="{{ $artist->firstname }} {{ $artist->lastname }}" width="200" class="mx-auto d-block"></p>
        @else
            <canvas width="200" height="100" style="border:1px solid #000000;" class="mx-auto d-block"></canvas>
        @endif

        <h2>Liste des types</h2>
        @if ($artist->types->count() >= 1)
            <ul class="list-unstyled">
                @foreach($artist->types as $type)
                    <li>{{ $type->type }}</li>
                @endforeach
            </ul>
        @else
            <p>Aucun type</p>
        @endif

        <div><a href="{{ route('artist.edit', $artist->id) }}">Modifier</a></div>

        <form method="post" action="{{ route('artist.delete', $artist->id) }}" style="display: inline;">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Supprimer</button>
        </form>
    </article>

    <nav class="text-center">
        <a href="{{ route('artist.index') }}">Retour à l'index</a>
    </nav>
@endsection
