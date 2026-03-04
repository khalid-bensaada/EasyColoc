<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvitationController;
use App\Models\Colocation;


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


    Route::post(
        '/member/colocations',
        [ColocationController::class, 'store']
    )->name('colocation.store');

    Route::get(
        '/member/colocations/create',
        [ColocationController::class, 'create']
    )->name('member.colocations.createForm');



    Route::get('/member/colocations',  [ColocationController::class, 'index'])->name('member.colocations.index');


    Route::post('/colocation/{id}/cancel', [ColocationController::class, 'cancel'])
        ->name('colocation.cancel');


    Route::post('/colocations/join', [ColocationController::class, 'join'])
        ->name('colocations.join');
});








Route::middleware(['auth'])->group(function () {});

Route::middleware(['auth'])->group(function () {

    Route::post('/member/expenses/store', [ExpenseController::class, 'store'])->name('expenses.store');
});




Route::middleware(['auth'])->group(function () {





    Route::post('/colocations/store', [ColocationController::class, 'store'])
        ->name('colocations.store');


    Route::post('/colocations/join', [ColocationController::class, 'join'])
        ->name('colocations.join');
});




Route::middleware(['auth'])->prefix('member')->name('member.')->group(function () {


    Route::prefix('colocations')->name('colocations.')->group(function () {

        Route::get('/', [ColocationController::class, 'index'])->name('index');

        Route::get('/join/{token?}', [ColocationController::class, 'joinForm'])->name('joinForm');

        Route::post('/join', [ColocationController::class, 'join'])->name('join');
    });
});


Route::middleware(['auth'])->group(function () {


    Route::get('/dashboard', function () {
        return view('member.dashboard');
    })->name('dashboard');
});

Route::get('/member/colocations/ownercoloc/{id}', [ColocationController::class, 'showOwnerColoc'])
    ->name('member.colocations.ownercoloc');

Route::get('/member/colocations/user-dash', function () {
    return view('member.colocations.userDash');
})->name('member.colocations.userDash');

Route::get(
    '/member/colocations/join',
    [ColocationController::class, 'joinForm']
)->name('member.colocations.joinForm');

Route::get(
    '/member/colocations/user-dash',
    [ColocationController::class, 'userDash']
)->name('member.colocations.userDash')
    ->middleware('auth');

Route::post(
    '/member/colocations/user-dash',
    [ColocationController::class, 'userDashProcess']
)->name('member.colocations.userDash.process');


Route::middleware(['auth'])->group(function () {
    Route::post('/colocations/invite', [ColocationController::class, 'sendInvitation'])
        ->name('colocations.invite');
});
