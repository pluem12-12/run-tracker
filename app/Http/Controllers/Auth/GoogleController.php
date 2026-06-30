<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    // โยนผู้ใช้ไปที่หน้าต่างล็อกอินของ Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // รับข้อมูลกลับมาจาก Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // ค้นหาว่ามีอีเมลนี้ในระบบหรือยัง
            $user = User::where('google_id', $googleUser->id)->orWhere('email', $googleUser->email)->first();

            if (!$user) {
                // ถ้ายังไม่มี ให้สร้างยูสเซอร์ใหม่
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt('123456dummy') // ใส่รหัสผ่านหลอกไว้
                ]);
            } else {
                // ถ้าเคยสมัครอีเมลปกติไว้ ให้อัปเดต google_id ให้
                $user->update(['google_id' => $googleUser->id]);
            }

            Auth::login($user);
            return redirect()->intended('/dashboard'); // ล็อกอินสำเร็จส่งไปหน้า Dashboard

        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['email' => 'การเข้าสู่ระบบด้วย Google ขัดข้อง กรุณาลองใหม่']);
        }
    }
}