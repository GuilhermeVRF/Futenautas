<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FootballPlayerController;
use App\Http\Controllers\TeamPlayerController;
use App\Http\Controllers\RoundLineupController;

Route::get('/', function() {
    return view('user.login');
});

Route::controller(UserController::class)->group( function () {
    Route::get('/signup', 'index');
    Route::post('store',  'store')->name('user.store');
});

Route::controller(LoginController::class)->group( function () {
    Route::get('/login',  'index')->name('login');
    Route::post('/authenticate',  'authenticate')->name('user.authenticate');
});

Route::controller(FootballPlayerController::class)->group( function () {
    Route::get('/players',  'index')->name('listAllPlayers');
    Route::post('/players',  'INDEX')->name('listAllPlayers');
})->middleware('auth.basic');

Route::controller(TeamPlayerController::class)->group( function () {
    Route::get('/teamPlayer/create',  'create')->name('teamPlayer.create');
    Route::post('/teamPlayer/store',  'store')->name('teamPlayer.store');
});

Route::controller(RoundLineupController::class)->group( function () {
    Route::post('/roundLineup/store',  'store')->name('roundLineup.store');
    Route::get('roundLineup', 'index')->name('roundLineup');
    Route::post('/roundLineup/delete', 'destroy')->name('roundLine.destroy');
});
