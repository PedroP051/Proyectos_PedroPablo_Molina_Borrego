<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\ComentarioController;

Route::get('/articulos', [ArticuloController::class, 'index']);
Route::get('/articulos/{id}', [ArticuloController::class, 'show']);
Route::post('/articulos', [ArticuloController::class, 'store']);
Route::put('/articulos/{id}', [ArticuloController::class, 'update']);
Route::delete('/articulos/{id}', [ArticuloController::class, 'destroy']);

Route::get('/comentarios', [ComentarioController::class, 'index']);
Route::get('/comentarios/{id}', [ComentarioController::class, 'show']);
Route::get('/articulos/{id}/comentarios', [ComentarioController::class, 'comentariosPorArticulo']);
Route::post('/articulos/{id}/comentarios', [ComentarioController::class, 'store']);
Route::put('/comentarios/{id}', [ComentarioController::class, 'update']);
Route::delete('/comentarios/{id}', [ComentarioController::class, 'destroy']);
