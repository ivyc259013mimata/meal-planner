<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/recipe', [RecipeController::class, 'index']);
Route::post('/recipe/store', [RecipeController::class, 'store']);
Route::get('/recipe/{id}/edit', [RecipeController::class, 'edit']);
Route::post('/recipe/{id}/update', [RecipeController::class, 'update']);
Route::post('/recipe/{id}/delete', [RecipeController::class, 'destroy']);
