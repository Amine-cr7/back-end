<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\RegisterUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('categories',CategorieController::class);
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::apiResource('produits',ProduitController::class);
Route::apiResource('images',ImageController::class);
Route::get('/filters',[ProduitController::class,'filters']);
Route::get('/fav/{user_id}',[FavoriteController::class,'index']);
Route::post('/fav/{user_id}/{produit_id}',[FavoriteController::class,'store']);
Route::delete('/fav/{user_id}/{produit_id}',[FavoriteController::class,'destroy']);
Route::post('/cart/{user_id}/{produit_id}',[CartController::class,'store']);
Route::get('/cart/{user_id}',[CartController::class,'index']);
Route::put('/cart/{user_id}',[CartController::class,'update']);
Route::delete('/cart/{user_id}/{produit_id}',[CartController::class,'destroy']);
Route::post('/commande',[CommandeController::class,'store']);
Route::get('/countries',[CountryController::class,'index']);
Route::get('/commandes/{user_Id}',[CommandeController::class,'index']);
Route::post('/information',[InfoController::class,'store']);
Route::get('/information/{userId?}',[InfoController::class,'index']);
Route::put('/information',[InfoController::class,'update']);
Route::get('/paiement/{userId}',[PaiementController::class,'index']);
Route::post('/paiement',[PaiementController::class,'store']);

