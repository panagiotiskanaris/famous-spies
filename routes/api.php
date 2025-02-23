<?php

use App\Http\Controllers\Agency\AssignSpyController;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\LogoutController;
use App\Http\Controllers\Spy\RandomSpiesController;
use App\Http\Controllers\Spy\SpyController;
use Illuminate\Support\Facades\Route;

Route::post('login', LoginController::class);

Route::middleware('auth:sanctum')
    ->group(function () {
        Route::post('logout', LogoutController::class);

        Route::resource('spies', SpyController::class)->only(['index', 'store', 'destroy']);

        Route::get('random-spies', RandomSpiesController::class)->middleware('throttle:10,1');

        Route::patch('agencies/{agency}/spies/{spy}/assign', AssignSpyController::class);
    });
