<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\UserController;

Route::middleware('auth')->group(function () {

    Route::get(
        '/user/dashboard',
        [UserController::class, 'dashboard']
    )->name('user.dashboard');

    Route::get(
        '/certificate/detail/{id}',
        [CertificateController::class, 'detail']
    )->name('certificate.detail');

    Route::get(
        '/admin/sertifikat',
        [CertificateController::class, 'index']
    );

    Route::get(
        '/admin/sertifikat/{event}',
        [CertificateController::class, 'show']
    )->where('event', '.*');

    Route::get(
        '/certificate/download/{id}',
        [CertificateController::class, 'download']
    )->name('certificate.download');

    Route::post(
        '/admin/sertifikat/delete',
        [CertificateController::class, 'destroy']
    );

    Route::post(
        '/admin/sertifikat/delete-event',
        [CertificateController::class, 'destroyEvent']
    );

});

Route::post('/admin/generate', [CertificateController::class, 'store'])->middleware('auth');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::post('/login-admin', [AuthController::class, 'loginAdmin']);

Route::post('/register-admin', [AuthController::class, 'registerAdmin']);

Route::post('/register', [AuthController::class, 'register']);

Route::get('/', function () {
    return view('home');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/login', function () {
    return view('login');
});

Route::get('/register_admin', function () {
    return view('register_admin');
});

Route::get('/login_admin', function () {
    return view('login_admin');
});

Route::get('/admin/generate', function () {
    return view('admin.generate');
})->middleware('auth');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth');

// Public API to verify certificate by number (used on home page)
Route::get(
    '/certificate/check/{number}',
    [CertificateController::class, 'check']
)->where('number', '.*');