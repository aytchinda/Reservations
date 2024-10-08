@extends('home.homepage')

@section('title', 'Fiche d\'un spectacle')

@section('content')
    <article class="text-center" style="margin: 0 auto; max-width: 800px;">
        <h1>{{ $show->title }}</h1>

        @if ($show->poster_url)
            <p><img src="{{ asset('images/' . $show->poster_url) }}" alt="{{ $show->title }}" width="200" class="mx-auto d-block"></p>
        @else
            <canvas width="200" height="100" style="border:1px solid #000000;" class="mx-auto d-block"></canvas>
        @endif

        @if ($show->location)
            <p><strong>Lieu de création:</strong> {{ $show->location->designation }}</p>
        @endif

        <p><strong>Prix:</strong> {{ $show->price }} €</p>

        @if ($show->bookable)
            <p><em>Réservable</em></p>
        @else
            <p><em>Non réservable</em></p>
        @endif

        <h2>Liste des représentations</h2>
        @if ($show->representations->count() >= 1)
            <ul class="list-unstyled">
                @foreach ($show->representations as $representation)
                    <li>{{ $representation->when }}
                        @if ($representation->location)
                            ({{ $representation->location->designation }})
                        @elseif($representation->show->location)
                            ({{ $representation->show->location->designation }})
                        @else
                            (lieu à déterminer)
                        @endif
                    </li>
                @endforeach
            </ul>
        @else
            <p>Aucune représentation</p>
        @endif

        <h2>Liste des artistes</h2>
        <p><strong>Auteur:</strong>
            @foreach ($collaborateurs['auteur'] as $auteur)
                {{ $auteur->firstname }}
                {{ $auteur->lastname }}@if ($loop->iteration == $loop->count - 1)
                    et
                @elseif(!$loop->last)
                    ,
                @endif
            @endforeach
        </p>
        <p><strong>Metteur en scène:</strong>
            @foreach ($collaborateurs['scénographe'] as $scenographe)
                {{ $scenographe->firstname }}
                {{ $scenographe->lastname }}@if ($loop->iteration == $loop->count - 1)
                    et
                @elseif(!$loop->last)
                    ,
                @endif
            @endforeach
        </p>
        <p><strong>Distribution:</strong>
            @foreach ($collaborateurs['comédien'] as $comedien)
                {{ $comedien->firstname }}
                {{ $comedien->lastname }}@if ($loop->iteration == $loop->count - 1)
                    et
                @elseif(!$loop->last)
                    ,
                @endif
            @endforeach
        </p>
    </article>

    <nav class="text-center">
        <a href="{{ route('show.index') }}">Retour à l'index</a>
    </nav>
@endsection
