<?php

use App\Http\Controllers\Agency\AssignSpyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Spy\RandomSpiesController;
use App\Http\Controllers\Spy\SpyController;
use Illuminate\Support\Facades\Route;

Route::post('login', LoginController::class);

Route::middleware('auth:sanctum')
    ->group(function () {
        Route::resource('spies', SpyController::class)->only(['index', 'store']);

        Route::get('random-spies', RandomSpiesController::class)->middleware('throttle:10,1');

        Route::patch('agencies/{agency}/spies/{spy}/assign', AssignSpyController::class);
    });
