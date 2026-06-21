<?php

use Illuminate\Support\Facades\Route;

/**
 * Rutas Web
 * Estas rutas son para renderizar vistas (páginas HTML).
 * Las rutas retornan vistas Blade.
 */

// Ruta raíz: página de inicio
Route::view('/', 'home');

// Ruta para listar equipos
Route::view('/equipos', 'equipos');

// Ruta para listar jugadores
Route::view('/jugadores', 'jugadores');
//ruta para listar partidos
Route::view('/partidos', 'partidos');