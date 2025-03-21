<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;

Route::middleware(['check.link'])->group(function () {
    Route::get('/', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::get('/page/{token}', [PageController::class, 'showPage'])->name('page.show');
Route::post('/page/{token}/generate', [PageController::class, 'generateLink'])->name('page.generate');
Route::post('/page/{token}/deactivate', [PageController::class, 'deactivateLink'])->name('page.deactivate');
Route::post('/page/{token}/lucky', [PageController::class, 'feelingLucky'])->name('page.lucky');
Route::get('/page/{token}/history', [PageController::class, 'history'])->name('page.history');