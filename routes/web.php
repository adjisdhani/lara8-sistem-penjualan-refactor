<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\HTTP\Controllers\ExportDataController;

require __DIR__.'/dashboard.php';
require __DIR__.'/penjualan.php';
require __DIR__.'/users.php';


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Menu Tambahan
Route::get('/about-me', function () {
    $active = "about_me";
    return view('Menutambahan.about', compact('active'));
});

Route::get('/dokumentasi-web', function () {
    $active = "dokumentasi_web";
    return view('Menutambahan.dokumentasi', compact('active'));
});
// Menu Tambahan
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('/export-data', ExportDataController::class)->except(['show']);
    Route::post('/export-data/execute', [ExportDataController::class, 'execute'])->name('export.data.execute');

});

Route::fallback(function () {
    return 'Fallback route triggered!';
});
