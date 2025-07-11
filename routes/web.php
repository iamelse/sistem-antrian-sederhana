<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\QueueController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\QueueTakeController;

Route::get('/', function () {
    return view('welcome');
});

// Guest (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
    Route::post('/auth/login', [AuthController::class, 'authenticate'])->name('do.login');
});

// Authenticated
Route::middleware('auth')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/queue', [QueueController::class, 'index'])->name('queue.index');
    Route::get('/admin/queue/list', [QueueController::class, 'list'])->name('queue.list');
    Route::post('/call', [QueueController::class, 'call'])->name('queue.call');
    Route::post('/admin/queue/skip', [QueueController::class, 'skip'])->name('queue.skip');
    Route::post('/admin/queue/next', [QueueController::class, 'next'])->name('queue.next');
    Route::post('/admin/queue/prev', [QueueController::class, 'prev'])->name('queue.prev');
});

Route::middleware('guest')->group(function () {
    Route::get('/queue/take', [QueueTakeController::class, 'index'])->name('queue.take');
    Route::get('/queue/next-number', [QueueTakeController::class, 'nextNumber'])->name('queue.next-number');
    Route::post('/queue/take/store', [QueueTakeController::class, 'store'])->name('queue.take.store');
});
