<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ParseRequestExtends;
use App\Http\Middleware\CheckIsAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
    'namespace' => '\\App\\Http\\Controllers\\'
], function () {
    Route::post('register', "AuthController@register");
    Route::post('login', "AuthController@login");
    Route::post('logout', "AuthController@logout");
    Route::post('refresh', "AuthController@refresh");
    Route::post('me', "AuthController@me");
});

Route::group([
    'prefix' => 'files',
    'middleware' =>  ['api', 'auth.check'],
    'namespace' => '\\App\\Http\\Controllers\\'
], function () {
    Route::post("/", 'FileController@upload');
    Route::delete("/{id}", 'FileController@deleteById');
});

Route::group([
    'prefix' => 'users',
    'middleware' => ['api', 'auth.check'],
    'namespace' => '\\App\\Http\\Controllers\\'
], function () {
    Route::get("/", "UserController@index");
});

Route::group([
    'prefix' => 'profile',
    'middleware' => ['api', 'auth.check'],
    'namespace' => '\\App\\Http\\Controllers\\'
], function () {
    Route::get("/", "ProfileController@getProfile");
    Route::post("/", "ProfileController@updateProfile");
});

Route::group([
    'prefix' => 'friends',
    'middleware' => ['api', 'auth.check'],
    'namespace' => '\\App\\Http\\Controllers\\'
], function () {
    Route::get("/", "FriendController@getFriends");
    Route::post("/{id}", "FriendController@makeFriend");
    Route::delete("/{id}", "FriendController@unFriend");
});
