<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardController::class)->name('dashboard');
Route::get('/blank', [PageController::class, 'blank'])->name('pages.blank');
Route::get('/login', [PageController::class, 'login'])->name('login');
