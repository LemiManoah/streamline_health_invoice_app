<?php

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


Route::get('/', function () {
    return view('auth.login');
});




Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::resource('permissions', PermissionController::class);
    Route::get('/permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);

    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::get('/users/{userId}/delete', [\App\Http\Controllers\UserController::class, 'destroy'])->name('userdelete');

    
    Route::resource('roles', RoleController::class);
    Route::get('/roles/{roleId}/destroy', [RoleController::class, 'destroy'])->name('delete');
    Route::get('/roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole'])->name('showAddPermission');
    Route::put('/roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole'])->name('givePermissions');
    
    Route::prefix('reports')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/generate', [ReportController::class, 'generate'])->name('reports.generate');
        Route::post('/export', [ReportController::class, 'export'])->name('reports.export');
    });

});

    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
    
        return redirect('/dashboard');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
     
        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');


require __DIR__.'/auth.php';