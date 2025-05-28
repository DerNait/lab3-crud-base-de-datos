<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeliculaPersona extends Model
{
    public $timestamps = true;
    protected $guarded = ['id'];

    public function pelicula(): BelongsTo
    {
        return $this->belongsTo(Pelicula::class);
    }

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class);
    }
}
