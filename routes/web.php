<?php

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', function () {
    return view('auth.login');
});



Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('permissions', PermissionController::class);
    Route::get('/permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);

    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::get('/users/{userId}/delete', [\App\Http\Controllers\UserController::class, 'destroy'])->name('userdelete');

    
    Route::resource('roles', RoleController::class);
    Route::get('/roles/{roleId}/destroy', [RoleController::class, 'destroy'])->name('delete');
    Route::get('/roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole'])->name('showAddPermission');
    Route::put('/roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole'])->name('givePermissions');
    

    // Route::get('/sendmail', [SendMailController::class,'sendMail'])->name('sendMail');
});


require __DIR__.'/auth.php';