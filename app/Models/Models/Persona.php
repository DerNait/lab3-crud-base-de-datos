<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    protected $fillable = ['nombre'];

    public function peliculas(): BelongsToMany
    {
        return $this->belongsToMany(Pelicula::class, 'pelicula_personas', 'persona_id', 'pelicula_id')
            ->withPivot('rol')
            ->withTimestamps();
    }
}
