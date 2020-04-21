<?php

use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\TeamController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;

// Redirect the user to client application
Route::get('/', [ApplicationController::class, 'redirect'])->name('index');

// The routes that are used to authenticate the user
Route::get('/login', [AuthenticationController::class, 'gate'])->name('authentication.gate');
Route::post('/login', [AuthenticationController::class, 'login'])->name('authentication.login');


// All other routes are prefixed with the /admin path and requires an authenticated session
Route::prefix('/admin')
    ->middleware(Authenticate::class)
    ->group(static function () {
        // The logout route should be only accessible, if the user is already logged in
        Route::any('/logout', [AuthenticationController::class, 'logout'])->name('authentication.logout');

        Route::get('/', [AdministrationController::class, 'index'])->name('administration.index');

        Route::resource('institutions', InstitutionController::class)->except('index');
        Route::resource('institutions.teams', TeamController::class)->except('index');
    });
