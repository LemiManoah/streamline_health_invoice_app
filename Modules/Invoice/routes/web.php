<?php

use Illuminate\Support\Facades\Route;
use Modules\Invoice\Http\Controllers\InvoiceController;

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
});

Route::get('/Invoicedashboard', [InvoiceController::class, 'dummy'])->name('invoicedashboard');
Route::post('/get-amount', [InvoiceController::class, 'getAmount'])->name('get.amount');

