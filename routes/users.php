<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingUserController;
use App\Http\Controllers\SettingMenuController;

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::resource('/setting-user', SettingUserController::class)->except(['show']);
    Route::resource('/setting-menu', SettingMenuController::class)->except(['show']);

    Route::get('/setting-menu/{id}/add_action', [App\Http\Controllers\SettingMenuController::class, 'add_action']);
    Route::post('/setting-menu/{id}/add_action_proses', [App\Http\Controllers\SettingMenuController::class, 'add_action_proses'])->name('setting-menu.add-action-proses');;
});