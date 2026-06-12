<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Middleware\EnsureApiDomain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware([EnsureApiDomain::class])->group(function () {

    Route::post(
        '/login',
        [AuthController::class, 'login']
    );

    //Auth routes 
    Route::middleware('auth:sanctum')->group(function () {

        // Get current authenticated user's role
        Route::get('users/me' , [AuthController::class , 'me']);
        Route::delete('/auth/logout' , [AuthController::class , 'logout']);
    });
        
});
