<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserActivityController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::controller(AuthController::class)->prefix('user')->group(function () {
    Route::get('change-password', 'showChangePasswordForm')->name('user.show-change-password');
    Route::post('change-password', 'changePassword')->name('user.change-password');
});

Route::controller(AuthController::class)->group(function () {
    Route::prefix('/')->group(function () {
        Route::get('/', 'showLoginForm')->name('login');
        Route::get('login', 'showLoginForm')->name('login');
        Route::post('/login', 'login')->name('login1');
        Route::post('/logout', 'logout')->name('logout1');
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/logout', function () {
            Auth::logout();
            return redirect('/');
        })->name('logout');
    });


    Route::controller(RoleController::class)->prefix('role')->group(function () {
        Route::get('/', 'index')->name('role.index');
        Route::get('create', 'create')->name('role.create');
        Route::post('store', 'store')->name('role.store');
        Route::get('edit/{id}', 'edit')->name('role.edit');
        Route::delete('delete/{id}', 'destroy')->name('role.delete');
        Route::put('update/{id}', 'update')->name('role.update');
        Route::get('trash', 'trash')->name('role.trash');
        Route::get('restore/{id}', 'restore')->name('role.restore');
    });

    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('/', 'index')->name('user.index');
        Route::get('create', 'create')->name('user.create');
        Route::post('store', 'store')->name('user.store');
        Route::get('edit/{id}', 'edit')->name('user.edit');
        Route::delete('delete/{id}', 'destroy')->name('user.delete');
        Route::put('update/{id}', 'update')->name('user.update');
        Route::get('trash', 'trash')->name('user.trash');
        Route::get('restore/{id}', 'restore')->name('user.restore');
    });

    Route::controller(UserActivityController::class)->prefix('user_activity')->group(function () {
        Route::get('/', 'index')->name('user_activity.index');
    });

    Route::controller(CompanyController::class)->prefix('company')->group(function () {
        Route::get('/', 'index')->name('company.index');
        Route::get('create', 'create')->name('company.create');
        Route::post('store', 'store')->name('company.store');
        Route::get('edit/{id}', 'edit')->name('company.edit');
        Route::delete('delete/{id}', 'destroy')->name('company.delete');
        Route::put('update/{id}', 'update')->name('company.update');
        Route::get('trash', 'trash')->name('company.trash');
        Route::get('restore/{id}', 'restore')->name('company.restore');
    });
});
