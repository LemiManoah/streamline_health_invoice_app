<?php

use Illuminate\Support\Facades\Route;
use Modules\Client\Http\Controllers\ClientController;
use Modules\Client\Http\Controllers\ClientVerificationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([], function () {
    Route::resource('clients', ClientController::class)->names('clients');
});

// Custom verification route
Route::get('/clients/verify/{token}', [ClientVerificationController::class, 'verify'])->name('clients.custom.verify');
