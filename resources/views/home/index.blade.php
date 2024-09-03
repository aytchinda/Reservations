@extends('home.homepage')

@section('content')
<div class="container mt-5">
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
