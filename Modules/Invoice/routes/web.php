<?php

use Illuminate\Support\Facades\Route;
use Modules\Invoice\Http\Controllers\InvoiceController;
use Modules\Invoice\Http\Controllers\SendMailController;

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
    Route::resource('invoices', InvoiceController::class);
    Route::post('/get-subscription-details', [InvoiceController::class, 'getSubscriptionDetails'])->name('get.subscription.details');

});

Route::get('/invoice/search', [InvoiceController::class, 'search'])->name('invoice.search');