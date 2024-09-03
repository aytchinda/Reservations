<!-- resources/views/payment/success.blade.php -->
@extends('home.homepage')

@section('content')
<div class="container">
    <h1>Paiement réussi !</h1>
    <p>Merci pour votre réservation.</p>
</div>

<div class="d-flex justify-content-between mt-4">
    <a href="{{ route('reservation.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour à la liste
    </a>
</div>
@endsection
