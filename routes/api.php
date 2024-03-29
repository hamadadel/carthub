<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\MeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Categories\CategoryController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('/categories', CategoryController::class);
Route::resource('/products', ProductController::class);
Route::resource('/cart', CartController::class);

Route::group(['prefix' => 'auth'], function () {

    Route::post('register', RegisterController::class);
    Route::post('login', LoginController::class);
    Route::get('me', MeController::class);
});

Route::get('login', function () {
    return response()->json(['message' => 'unauthenticated'], 401);
})->name('login');
