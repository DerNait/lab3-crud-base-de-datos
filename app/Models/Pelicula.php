<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    protected $guarded = ['id'];

    public function personas()
    {
        return $this->belongsToMany(Persona::class, 'pelicula_personas', 'pelicula_id', 'persona_id')
            ->withPivot('rol')
            ->withTimestamps();
    }

    public function premios()
    {
        return $this->belongsToMany(Premio::class, 'pelicula_premios', 'pelicula_id', 'premio_id')
            ->withPivot('año')
            ->withTimestamps();
    }
}
