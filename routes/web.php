<?php

use App\Http\Controllers\AdministratorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FootballPlayerController;
use App\Http\Controllers\FootballTeamController;
use App\Http\Controllers\TeamPlayerController;
use App\Http\Controllers\RoundLineupController;

Route::get('/', function() {
    return view('user.login');
});

Route::controller(AdministratorController::class)->group( function () {
    Route::get('admin/menu', 'menu')->name('admin-menu');
    Route::get('admin/login', 'index');
    Route::post('admin/authenticate',  'authenticate')->name('user.authenticate');
});

Route::controller(FootballTeamController::class)->group( function () {
    Route::get('/team/create',  'create')->name('team.create');
    Route::post('/team/store',  'store')->name('team.store');
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
    Route::get('/player/create',  'create')->name('player.create');
    Route::get('/players',  'index')->name('listAllPlayers');
    Route::post('/players',  'index')->name('listAllPlayers');
    Route::post('/player/store',  'store')->name('player.store');
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
