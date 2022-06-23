<?php

use App\Http\Controllers\clientController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(clientController::class)->group(function(){
    Route::get("/","accueil");
    Route::get("boutique","boutique");
    Route::get("panier", "panier");
    Route::get("contact","contact");
    Route::get("propos","propos");
});
