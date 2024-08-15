<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function() {
    return view('user.signin');
});


Route::get('/signup', [UserController::class, 'index']);
Route::get('/signin', function() {
    return view('user.signin');
});

Route::post('/register', [UserController::class, 'store'])->name('user.register');
Route::post('/login', [UserController::class, 'login'])->name('user.login');
