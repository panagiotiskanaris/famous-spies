<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\Spies\RandomSpiesController;
use App\Http\Controllers\Spies\SpyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', LoginController::class);

Route::middleware('auth:sanctum')
    ->group(function () {
        Route::get('user', function (Request $request) {
            return $request->user();
        });

        Route::resource('spies', SpyController::class)->only(['store']);
        Route::get('random-spies', RandomSpiesController::class)->middleware('throttle:10,1');
    });
