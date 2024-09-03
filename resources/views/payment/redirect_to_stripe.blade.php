@extends('home.homepage')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4 text-center">Redirection vers le paiement...</h1>
        <p class="text-center">Veuillez patienter pendant que nous vous redirigeons vers la page de paiement.</p>
        <form id="payment-form" action="{{ route('payment.create') }}" method="POST">
            @csrf
            <input type="hidden" name="reservation_id" value="{{ $reservation_id }}">
            <input type="hidden" name="show_title" value="{{ $show_title }}">
            <input type="hidden" name="total_price" value="{{ $total_price }}">
        </form>

        <script>
            document.getElementById('payment-form').submit();
        </script>
    </div>
@endsection
