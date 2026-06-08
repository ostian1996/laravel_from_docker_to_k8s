<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureAdminDomain;
use Illuminate\Support\Facades\Route;

Route::middleware([EnsureAdminDomain::class])->group(function () {

    Route::get('/', fn() => redirect()->route('login'));

    Auth::routes();

    Route::middleware('auth')->group(function () {
        // Dashboard routes
        Route::get('dashboard', [DashboardController::class, 'index'])->name('home');

        // Rôles and Users routes
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class)->except('show');
    });
});
