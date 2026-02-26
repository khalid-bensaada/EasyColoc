<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ColocationController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('member.dashboard');
    })->name('dashboard');
});


Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo');

    Route::post('/colocation/leave', [ProfileController::class, 'leaveColocation'])->name('colocation.leave');

    Route::post('/colocation/cancel', [ProfileController::class, 'cancelColocation'])->name('colocation.cancel');
});


Route::get('/member/colocations', function () {
    return view('member.colocations.index');
})->middleware('auth')->name('member.colocations.index');


Route::get('/member/colocations/create',
    [ColocationController::class, 'create']
)->name('member.colocations.create');

Route::post('/member/colocations',
    [ColocationController::class, 'store']
)->name('colocation.store');