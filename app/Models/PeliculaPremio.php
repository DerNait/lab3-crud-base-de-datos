<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeliculaPremio extends Model
{
    public $timestamps = true;
    protected $guarded = ['id'];

    public function pelicula()
    {
        return $this->belongsTo(Pelicula::class);
    }

    public function premio()
    {
        return $this->belongsTo(Premio::class);
    }
}
