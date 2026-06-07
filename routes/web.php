<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);

Route::post('/register-admin', [AuthController::class, 'registerAdmin']);

Route::post('/register', [AuthController::class, 'register']);

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register_admin', function () {
    return view('register_admin');
});

Route::get('/login_admin', function () {
    return view('login_admin');
});

Route::get('/user/dashboard', function () {
    return view('user.dashboard');
});