<?php

namespace App\Http\Controllers;

use App\Models\Run;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RunController extends Controller
{
    // แสดงรายการวิ่งใน Dashboard
    public function index()
    {
        $runs = Run::where('user_id', auth()->id())->orderBy('run_date', 'desc')->get();
        return view('dashboard', compact('runs'));
    }

    // บันทึกการวิ่ง (รวมอัปโหลดรูป)
    public function store(Request $request)
    {
        $request->validate([
            'distance' => 'required|numeric',
            'run_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('runs', 'public');
        }

        Run::create([
            'user_id' => Auth::id(),
            'distance' => $request->distance,
            'run_date' => $request->run_date,
            'image_path' => $path,
        ]);

        return back()->with('success', 'บันทึกข้อมูลการวิ่งเรียบร้อยแล้ว!');
    }

    // เพิ่มฟังก์ชันนี้ต่อท้ายฟังก์ชัน store
    public function leaderboard()
    {
        // 1. คำนวณระยะทางรวมของตัวเอง
        $myTotalDistance = \App\Models\Run::where('user_id', auth()->id())->sum('distance');

        // 2. ดึงข้อมูลผู้ใช้ทั้งหมด พร้อมรวมระยะทางวิ่ง และเรียงลำดับจากมากไปน้อย
        $users = \App\Models\User::withSum('runs', 'distance')
                    ->having('runs_sum_distance', '>', 0) // แสดงเฉพาะคนที่มีระยะทาง
                    ->orderBy('runs_sum_distance', 'desc')
                    ->get();

        return view('leaderboard', compact('users', 'myTotalDistance'));
    }
}