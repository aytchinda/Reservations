@extends('home.homepage')

@section('content')
    <article style="margin: 0 auto; max-width: 800px;">
        <h1 class="text-center">Liste des {{ $resource }}</h1>

        <ul class="text-center">
            <li><a href="{{ route('artist.create') }}" class="btn btn-primary">Ajouter un artiste</a></li>
        </ul>

        <table class="table table-striped text-center" style="width: 100%; margin: 20px auto;">
            <thead>
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($artists as $artist)
                    <tr>
                        <td>{{ $artist->firstname }}</td>
                        <td>
                            <a href="{{ route('artist.show', $artist->id) }}">{{ $artist->lastname }}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </article>
@endsection
