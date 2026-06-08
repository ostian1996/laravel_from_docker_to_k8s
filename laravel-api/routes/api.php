<?php

use App\Http\Middleware\EnsureApiDomain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware([EnsureApiDomain::class])->group(function () {

Route::get('/test', function () {
    return response()->json([
        'service' => 'API'
    ]);
});
    
});
