@extends('home.homepage')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4 text-center">Créer une Réservation</h1>

        <form action="{{ route('reservation.book') }}" method="POST">
            @csrf

            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

            <div class="form-group mb-4">
                <label for="representation" class="form-label">Choisir une représentation</label>
                <select name="representation_id" id="representation" class="form-select form-select-lg" required>
                    <option value="" disabled selected>Sélectionner une représentation</option>
                    @foreach ($representations as $representation)
                        <option value="{{ $representation->id }}"
                                data-price="{{ $representation->show->price }}"
                                data-title="{{ $representation->show->title }}"
                                data-description="{{ $representation->show->description }}"
                                data-image="{{ asset('images/' . $representation->show->poster_url) }}">
                            {{ $representation->show->title }} - {{ $representation->when }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row mb-4">
                <!-- Affichage de l'image du spectacle -->
                <div class="col-md-4 d-flex justify-content-center">
                    <div id="show-image-container" class="d-flex justify-content-center">
                        <img id="show-image" src="" alt="Image du spectacle" class="img-fluid rounded" style="max-width: 100%; height: auto; display: none;">
                    </div>
                </div>

                <!-- Affichage des détails du spectacle -->
                <div class="col-md-8">
                    <div class="form-group mb-4">
                        <label for="show-title" class="form-label">Titre du spectacle</label>
                        <input type="text" id="show-title" class="form-control form-control-lg" readonly>
                    </div>

                    <div class="form-group mb-4">
                        <label for="show-description" class="form-label">Description</label>
                        <textarea id="show-description" class="form-control form-control-lg" rows="4" readonly></textarea>
                    </div>

                    <!-- Affichage du prix du spectacle -->
                    <div class="form-group mb-4">
                        <label for="price" class="form-label">Prix</label>
                        <input type="text" id="price" class="form-control form-control-lg" readonly>
                    </div>
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="seats" class="form-label">Nombre de places</label>
                <input type="number" name="seats" id="seats" class="form-control form-control-lg" min="1" required>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100">
                <i class="fas fa-ticket-alt"></i> Réserver
            </button>
        </form>
    </div>

    <script>
        document.getElementById('representation').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            document.getElementById('show-title').value = selectedOption.getAttribute('data-title');
            document.getElementById('show-description').value = selectedOption.getAttribute('data-description');
            document.getElementById('price').value = selectedOption.getAttribute('data-price');

            var imageUrl = selectedOption.getAttribute('data-image');
            var imageElement = document.getElementById('show-image');

            if (imageUrl) {
                imageElement.src = imageUrl;
                imageElement.style.display = 'block';
            } else {
                imageElement.style.display = 'none';
            }
        });
    </script>
@endsection
