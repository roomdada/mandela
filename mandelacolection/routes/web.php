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

Route::get("/",[clientController::class,"accueil"]);
Route::get("boutique",[clientController::class,"boutique"]);
Route::get("panier",[clientController::class,"panier"]);
Route::get("contact",[clientController::class,"contact"]);
Route::get("propos",[clientController::class,"propos"]);
