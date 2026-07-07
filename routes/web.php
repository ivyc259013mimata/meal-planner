<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\IngredientController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/recipe', [RecipeController::class, 'index']);//一覧・検索
Route::post('/recipe/store', [RecipeController::class, 'store']);//新規登録フォームを保存
Route::get('/recipe/create', function() {
    return view('recipe.create');
});
Route::get('/recipe/{id}/edit', [RecipeController::class, 'edit']);//編集画面表示
Route::post('/recipe/{id}/update', [RecipeController::class, 'update']);//更新
Route::post('/recipe/{id}/delete', [RecipeController::class, 'destroy']);//削除

Route::get('/ingredient', [IngredientController::class, 'index']);
Route::post('/ingredient/store', [IngredientController::class, 'store']);
