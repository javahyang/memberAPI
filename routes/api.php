<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('signup', [UserController::class, 'signup']);
Route::post('signin', [UserController::class, 'signin']);
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('signout', [UserController::class, 'signout']);
    Route::get('users/details', [UserController::class, 'details']);
    Route::get('orders/details', [OrderController::class, 'details']);
});
Route::get('users', [UserController::class, 'list']);
Route::get('users/search', [UserController::class, 'search']);
