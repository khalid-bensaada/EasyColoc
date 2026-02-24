<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo');

    Route::post('/colocation/leave', [ProfileController::class, 'leaveColocation'])->name('colocation.leave');

    Route::post('/colocation/cancel', [ProfileController::class, 'cancelColocation'])->name('colocation.cancel');

});