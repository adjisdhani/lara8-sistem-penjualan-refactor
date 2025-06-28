<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::middleware(['auth', 'role:superadmin,user,staff'])->group(function () {
    Route::resource('/', DashboardController::class)->only(['index']);
});