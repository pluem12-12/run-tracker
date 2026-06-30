<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Run extends Model
{
    use HasFactory;

    // อนุญาตให้ฟอร์มส่งข้อมูล 4 ตัวนี้เข้ามาบันทึกได้
    protected $fillable = [
        'user_id',
        'run_date',
        'distance',
        'image_path',
    ];

    // บอกว่าการวิ่ง 1 ครั้ง เป็นของ User 1 คน
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}