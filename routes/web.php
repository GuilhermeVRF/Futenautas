<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FootballPlayerController;

Route::get('/', function() {
    return view('user.login');
});

Route::controller(UserController::class)->group( function () {
    Route::get('/signup', 'index');
    Route::post('/register',  'store')->name('user.register');
});

Route::controller(LoginController::class)->group( function () {
    Route::get('/login',  'index')->name('login');
    Route::post('/authenticate',  'authenticate')->name('user.authenticate');
});

Route::controller(FootballPlayerController::class)->group( function () {
    Route::get('/players/{filter}',  'index')->name('listPlayers');
})->middleware('auth');

