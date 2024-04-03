<?php

use App\Http\Controllers\Site\HomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('site.index');

});
