<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\RunController;
use App\Models\Run;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// use App\Http\Controllers\Auth\GoogleController; เรียกใช้งานผิดตัว ต้องเอาไปไว้ด้านบนสุดของไฟล์

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::post('/runs', [App\Http\Controllers\RunController::class, 'store'])->name('runs.store')->middleware('auth');
Route::get('/dashboard', function () {
    $user = Auth::user();
    
    // 1. ดึงประวัติการวิ่งทั้งหมดของตัวเอง
    $myRuns = $user->runs()->orderBy('run_date', 'desc')->get();
    
    // 2. คำนวณระยะทางรวมทั้งหมดของตัวเอง
    $myTotalDistance = $user->runs()->sum('distance');

    // 3. ดึงข้อมูลนักวิ่งทุกคน พร้อมรวมระยะทาง และนำมาจัดเรียงอันดับ
    $leaderboard = User::withSum('runs', 'distance')
                    ->get()
                    ->sortByDesc('runs_sum_distance')
                    ->values();

    // 4. ส่งข้อมูลทั้งหมดไปแสดงผล (บรรทัดนี้สำคัญมาก ห้ามหายเด็ดขาด)
    return view('dashboard', compact('myRuns', 'myTotalDistance', 'leaderboard'));
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';
