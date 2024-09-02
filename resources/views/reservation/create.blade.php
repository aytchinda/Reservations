<form action="{{ route('reservation.book') }}" method="POST">
    @csrf

    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

    <div class="form-group">
        <label for="representation">Choisir une représentation</label>
        <select name="representation_id" id="representation" class="form-control" required>
            @foreach($representations as $representation)
                <option value="{{ $representation->id }}">
                    {{ $representation->show->title }} - {{ $representation->when }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="seats">Nombre de places</label>
        <input type="number" name="seats" id="seats" class="form-control" min="1" required>
    </div>

    <button type="submit" class="btn btn-primary">Réserver</button>
</form>
