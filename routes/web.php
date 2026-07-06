<?php

use App\Http\Controllers\Admin\ApprovalController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route(auth()->user()->isAdmin() ? 'dash' : 'home');
    }

    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.attempt');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/home', [ReportController::class, 'home'])->name('home');
    Route::get('/lapor', [ReportController::class, 'lapor'])->name('lapor');
    Route::post('/lapor', [ReportController::class, 'storeHazard'])->name('lapor.store');
    Route::get('/darurat', [ReportController::class, 'darurat'])->name('darurat');
    Route::post('/darurat', [ReportController::class, 'storeEmergency'])->name('darurat.store');
    Route::get('/dash', [ReportController::class, 'dash'])->name('dash');
    Route::post('/reports/{report}/status', [ReportController::class, 'updateStatus'])->name('reports.status');
    Route::get('/profil', [ProfileController::class, 'show'])->name('profil');

    Route::middleware('admin')->group(function () {
        Route::get('/approve', [ApprovalController::class, 'index'])->name('approve');
        Route::post('/approve/{user}/approve', [ApprovalController::class, 'approve'])->name('approve.approve');
        Route::post('/approve/{user}/reject', [ApprovalController::class, 'reject'])->name('approve.reject');
    });
});
