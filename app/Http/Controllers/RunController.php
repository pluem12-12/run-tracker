<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Run;
use Illuminate\Support\Facades\Auth;

class RunController extends Controller
{
    public function store(Request $request)
    {
        // 1. ตรวจสอบความถูกต้องของข้อมูลที่ส่งมา
        $request->validate([
            'run_date' => 'required|date',
            'distance' => 'required|numeric|min:0.1',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120', // รับรูปขนาดไม่เกิน 5MB
        ]);

        // 2. อัปโหลดและบันทึกไฟล์รูปภาพลงในโฟลเดอร์ public/runs
        $imagePath = $request->file('image')->store('runs', 'public');

        // 3. บันทึกข้อมูลลงฐานข้อมูล
        Run::create([
            'user_id' => Auth::id(),
            'run_date' => $request->run_date,
            'distance' => $request->distance,
            'image_path' => $imagePath,
        ]);

        // 4. บันทึกเสร็จให้ส่งกลับไปหน้าเดิมพร้อมข้อความสำเร็จ
        return back()->with('success', 'บันทึกข้อมูลการวิ่งสำเร็จเรียบร้อยแล้ว!');
    }
}