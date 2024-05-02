<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Site\HomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {

	Route::get('/', [HomeController::class, 'index'])->name('site.index');

});

Route::middleware(['auth', 'verified'])->prefix('/admin')->group(function () {

	Route::get('/', [AdminHomeController::class, 'index'])->name('admin.index');
	Route::get('/dashboard', [AdminHomeController::class, 'index'])->name('dashboard');

});

require __DIR__ . '/auth.php';
