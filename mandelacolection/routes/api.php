<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategorieController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\PhotoController;
use App\Http\Controllers\API\CommandeController;
use App\Http\Controllers\API\PanierController;
use App\Http\Controllers\API\ClientController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('categories', CategorieController::class);
    Route::resource('article', ArticleController::class);
    Route::resource('photo', PhotoController::class);
    Route::resource('commande', CommandeController::class);
    Route::resource('panier', PanierController::class);
    Route::resource('client', ClientController::class);
});
