<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.auth.login');
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('password.confirm')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::get('users/datatable', [UserController::class, 'dataTable'])->name('users.datatable');
    Route::patch('users/{user}/active', [UserController::class, 'active'])->name('users.active');
    Route::resource('users', UserController::class)->except('show', 'create', 'edit');

    Route::get('staffs/datatable', [StaffController::class, 'dataTable'])->name('staffs.datatable');
    Route::patch('staffs/{staff}/active', [StaffController::class, 'active'])->name('staffs.active');
    Route::resource('staffs', StaffController::class)->except('show', 'create', 'edit');

    Route::get('settings/datatable', [SettingsController::class, 'dataTable'])->name('settings.datatable');
    Route::resource('settings', SettingsController::class)->except('show', 'create', 'edit');

    Route::get('roles/datatable', [RoleController::class, 'dataTable'])->name('roles.datatable');
    Route::resource('roles', RoleController::class)->except('show', 'create', 'edit');

    Route::middleware('role:Developer')->group(function () {
        Route::get('permissions/datatable', [PermissionController::class, 'dataTable'])->name('permissions.datatable');
        Route::resource('permissions', PermissionController::class)->except('show', 'create', 'edit');
    });
});

require __DIR__ . '/auth.php';
