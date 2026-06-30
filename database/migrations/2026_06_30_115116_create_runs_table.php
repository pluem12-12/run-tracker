<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('runs', function (Blueprint $table) {
            $table->id();
            // เก็บว่าการวิ่งนี้เป็นของ User คนไหน (ถ้าลบ User ข้อมูลวิ่งจะหายไปด้วย)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('run_date'); // วันที่วิ่ง
            $table->decimal('distance', 8, 2); // ระยะทางวิ่ง (กิโลเมตร) รับทศนิยม 2 ตำแหน่ง
            $table->string('image_path'); // ที่อยู่ไฟล์รูปภาพที่อัปโหลด
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('runs');
    }
};
