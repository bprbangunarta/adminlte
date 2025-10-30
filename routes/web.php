<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

// autentikasi
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'authenticate'])->name('login');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    // dashboard
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // user profile
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::group(['middleware' => ['role:Administrator']], function () {
        // import
        Route::post('/imports-users', [\App\Http\Controllers\ImportController::class, 'users'])->name('imports.users');

        // kelola hak akses
        Route::get('/permissions', [\App\Http\Controllers\PermissionController::class, 'index'])->name('permissions.index');
        Route::post('/permissions', [\App\Http\Controllers\PermissionController::class, 'store'])->name('permissions.store');
        Route::put('/permissions/{id}', [\App\Http\Controllers\PermissionController::class, 'update'])->name('permissions.update');
        Route::delete('/permissions/{id}', [\App\Http\Controllers\PermissionController::class, 'destroy'])->name('permissions.destroy');

        // kelola peranan
        Route::get('/roles', [\App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
        Route::post('/roles', [\App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
        Route::get('/roles/{id}', [\App\Http\Controllers\RoleController::class, 'show'])->name('roles.show');
        Route::post('/roles/{id}', [\App\Http\Controllers\RoleController::class, 'permission'])->name('roles.permission');
        Route::put('/roles/{id}', [\App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
        Route::delete('/roles/{id}', [\App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy');

        // kelola pengguna
        Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [\App\Http\Controllers\UserController::class, 'create'])->name('users.create');
        Route::post('/users', [\App\Http\Controllers\UserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}', [\App\Http\Controllers\UserController::class, 'show'])->name('users.show');
        Route::put('/users/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
        Route::put('/users/restore/{id}', [\App\Http\Controllers\UserController::class, 'restore'])->name('users.restore');
    });
});
