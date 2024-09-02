<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Reservation extends Pivot
{
    protected $table = 'reservations';

    protected $fillable = [
        'user_id',
        'representation_id',
        'seats',
        'show_id', // Ajouter show_id aux attributs remplissables
    ];

    public function representation()
    {
        return $this->belongsTo(Representation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function show()
    {
        return $this->belongsTo(Show::class);
    }
}
