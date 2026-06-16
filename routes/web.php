<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index'); // L'écran d'accueil
});

Route::get('/menu', function () {
    return view('menu'); // La sélection des cartes
});

Route::get('/game', function () {
    return view('game'); // Le champ de bataille
});