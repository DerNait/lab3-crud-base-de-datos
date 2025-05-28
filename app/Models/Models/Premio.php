<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Premio extends Model
{
    protected $fillable = ['nombre'];

    public function peliculas(): BelongsToMany
    {
        return $this->belongsToMany(Pelicula::class, 'pelicula_premios', 'premio_id', 'pelicula_id')
            ->withPivot('año')
            ->withTimestamps();
    }
}
