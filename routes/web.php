<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\RundownController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\WelcomeController;
use App\Http\Middleware\CheckVisitorRegistration;
use Illuminate\Support\Facades\Route;

// The Gate (Guest Access)
Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome');
Route::post('/visitor/register', [WelcomeController::class, 'store'])->name('visitor.store');

// Protected App Routes
Route::middleware([CheckVisitorRegistration::class])->group(function () {
    
    // Dashboard
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // University Catalog
    Route::get('/universities', [UniversityController::class, 'index'])->name('universities.index');
    Route::get('/universities/{university:slug}', [UniversityController::class, 'show'])->name('universities.show');

    // UMKM Catalog
    Route::get('/umkm', [UmkmController::class, 'index'])->name('umkm.index');
    Route::get('/umkm/{umkm}', [UmkmController::class, 'show'])->name('umkm.show');

    // Interactive Map
    Route::get('/map', [MapController::class, 'index'])->name('map.index');
    Route::get('/map/booth/{id}', [MapController::class, 'getBoothInfo'])->name('map.booth');


    // Event Rundown/Schedule
    Route::get('/rundown', [RundownController::class, 'index'])->name('rundown.index');
    
    // Favorites
    Route::post('/universities/{id}/toggle-favorite', [App\Http\Controllers\FavoriteController::class, 'toggle'])->name('universities.toggle-favorite');
});
