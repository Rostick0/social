<?php

use App\Http\Controllers\FriendController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ParseRequestExtends;
use Illuminate\Http\Request;
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
Route::get("users",[UserController::class,"index"])->middleware(ParseRequestExtends::class);
Route::post("friends",[FriendController::class,"create"]);

