<?php

use App\Http\Controllers\AdministratorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FootballPlayerController;
use App\Http\Controllers\FootballTeamController;
use App\Http\Controllers\TeamPlayerController;
use App\Http\Controllers\RoundLineupController;
use App\Http\Controllers\RoundController;
use App\Http\Controllers\FootballPlayerScoreController;

Route::get('/', function() {
    return view('user.login');
});

Route::controller(AdministratorController::class)->group( function () {
    Route::get('admin/menu', 'menu')->name('admin-menu')->middleware('auth');;
    Route::get('admin/login', 'index');
    Route::post('admin/authenticate',  'authenticate')->name('user.authenticate');
});

Route::controller(FootballTeamController::class)->group( function () {
    Route::get('/team/create',  'create')->name('team.create')->middleware('auth');;
    Route::post('/team/store',  'store')->name('team.store')->middleware('auth');;
    Route::get('/team/ranking',  'ranking')->name('team.ranking')->middleware('auth');;
});

Route::controller(UserController::class)->group( function () {
    Route::get('/signup', 'index');
    Route::get('/menu', 'menu')->name('user.menu')->middleware('auth');;
    Route::post('store',  'store')->name('user.store');
});

Route::controller(LoginController::class)->group( function () {
    Route::get('/login',  'index')->name('login');
    Route::post('/authenticate',  'authenticate')->name('user.authenticate');
});

Route::controller(FootballPlayerController::class)->group( function () {
    Route::get('/player/create',  'create')->name('player.create')->middleware('auth');;
    Route::get('/players',  'index')->name('listAllPlayers')->middleware('auth');;
    Route::post('/players',  'index')->name('listAllPlayers')->middleware('auth');;
    Route::post('/player/store',  'store')->name('player.store')->middleware('auth');;
})->middleware('auth.basic');

Route::controller(TeamPlayerController::class)->group( function () {
    Route::get('/teamPlayer/create',  'create')->name('teamPlayer.create');
    Route::get('/teamPlayer/ranking',  'ranking')->name('teamPlayer.ranking')->middleware('auth');;
    Route::post('/teamPlayer/ranking',  'ranking')->name('teamPlayer.ranking')->middleware('auth');;
    Route::post('/teamPlayer/store',  'store')->name('teamPlayer.store');
});

Route::controller(RoundController::class)->group( function () {
    Route::get('/round', 'index')->name('round.index')->middleware('auth');;
    Route::post('/finishRound', 'finishRound')->name('round.finish')->middleware('auth');;
});

Route::controller(RoundLineupController::class)->group( function () {
    Route::post('/roundLineup/store',  'store')->name('roundLineup.store')->middleware('auth');;
    Route::get('roundLineup', 'index')->name('roundLineup')->middleware('auth');;
    Route::post('/roundLineup/delete', 'destroy')->name('roundLine.destroy')->middleware('auth');;
});

Route::controller(FootballPlayerScoreController::class)->group( function () {
    Route::get('/footaballPlayerScore',  'index')->name('footaballPlayerScore.index')->middleware('auth');;
    Route::post('/footaballPlayerScore',  'index')->name('footaballPlayerScore.index')->middleware('auth');;
});
