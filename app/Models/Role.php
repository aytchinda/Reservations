<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [



    ];

    // Relation Many-to-Many avec le modèle User
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}


