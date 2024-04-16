<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ImageController;
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