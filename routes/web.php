<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculasController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return response()->json('test');
});

Route::resource('peliculas', PeliculasController::class);