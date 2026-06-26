<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\RunController;

// หน้าแรก
Route::get('/', function () {
    return view('welcome');
});

// หน้า Dashboard (เรียกผ่าน RunController เพื่อส่งข้อมูล $runs ไปแสดง)
Route::get('/dashboard', [RunController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// หน้าบันทึกข้อมูลวิ่ง
Route::post('/runs', [RunController::class, 'store'])
    ->name('runs.store')
    ->middleware('auth');

// ล็อกอินผ่าน Google
Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

// จัดการโปรไฟล์
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/leaderboard', [RunController::class, 'leaderboard'])->middleware(['auth', 'verified'])->name('leaderboard');

require __DIR__.'/auth.php';