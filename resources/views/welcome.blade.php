<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Run Tracker - ระบบสะสมระยะทางวิ่ง VIRTUAL RUN</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-50 text-slate-800 selection:bg-orange-500 selection:text-white font-['figtree']">
    
    <nav class="absolute top-0 w-full z-50 p-6 flex justify-between items-center max-w-7xl mx-auto inset-x-0">
        <div class="text-2xl font-extrabold tracking-tighter text-orange-600 flex items-center gap-2 drop-shadow-sm">
            <span>🏃‍♂️</span> RunTracker.
        </div>
        @if (Route::has('login'))
            <div class="flex items-center gap-2 sm:gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-slate-600 hover:text-orange-600 transition px-4 py-2">เข้าสู่แดชบอร์ด</a>
                @else
                    <a href="{{ route('login') }}" class="hidden sm:inline-block font-semibold text-slate-600 hover:text-orange-600 transition px-4 py-2">เข้าสู่ระบบ</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="font-bold text-white bg-slate-800 hover:bg-slate-700 px-5 py-2.5 rounded-full transition shadow-md">สมัครสมาชิกฟรี</a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>

    <div class="relative min-h-screen flex items-center justify-center pt-20 overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-[40rem] h-[40rem] bg-gradient-to-br from-orange-400/20 to-red-500/20 rounded-full blur-3xl -z-10"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-[30rem] h-[30rem] bg-gradient-to-tr from-indigo-400/10 to-blue-500/10 rounded-full blur-3xl -z-10"></div>

        <div class="max-w-7xl mx-auto px-6 text-center z-10 w-full">
            <span class="inline-block py-1.5 px-4 rounded-full bg-orange-100 text-orange-600 text-sm font-extrabold tracking-widest mb-8 border border-orange-200 shadow-sm animate-fade-in-up">
                🏆 VIRTUAL RUN 2026
            </span>
            
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-extrabold tracking-tight text-slate-900 mb-6 leading-tight">
                วิ่งที่ไหน เมื่อไหร่ก็ได้ <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-600">
                    สะสมระยะทางสู่เป้าหมาย
                </span>
            </h1>
            
            <p class="text-lg md:text-xl text-slate-500 mb-10 max-w-2xl mx-auto font-medium">
                แพลตฟอร์มบันทึกผลการวิ่งสำหรับนักวิ่งชาวไทย อัปโหลดภาพหลักฐานจากแอปพลิเคชันที่คุณถนัด และร่วมท้าทายขีดจำกัดบนตารางจัดอันดับ (Leaderboard) กับเพื่อนๆ
            </p>

            <div class="flex flex-col sm:flex-row justify-center items-center gap-4 w-full sm:w-auto px-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto px-8 py-4 text-lg font-bold text-white bg-gradient-to-r from-orange-500 to-red-600 rounded-2xl hover:from-orange-600 hover:to-red-700 hover:-translate-y-1 transition-all shadow-lg shadow-orange-500/40">
                        🏃‍♂️ กลับไปที่แดชบอร์ดของคุณ
                    </a>
                @else
                    <a href="{{ route('google.login') }}" class="w-full sm:w-auto flex items-center justify-center gap-3 px-8 py-4 text-lg font-bold text-slate-700 bg-white border-2 border-slate-200 rounded-2xl hover:border-orange-500 hover:text-orange-600 hover:-translate-y-1 transition-all shadow-sm">
                        <svg class="w-6 h-6" viewBox="0 0 24 24">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        ล็อกอินด้วย Google
                    </a>
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 text-lg font-bold text-white bg-gradient-to-r from-orange-500 to-red-600 rounded-2xl hover:from-orange-600 hover:to-red-700 hover:-translate-y-1 transition-all shadow-lg shadow-orange-500/40">
                        สมัครใช้งานฟรี
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <div class="bg-white py-24 border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-800">ระบบที่ออกแบบมาเพื่อนักวิ่ง</h2>
                <p class="text-slate-500 mt-4 text-lg">ใช้งานง่าย ตอบโจทย์ทุกการสะสมระยะ ไม่ว่าจะวิ่งลู่วิ่งหรือวิ่งเทรล</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
                <div class="p-6 rounded-3xl hover:bg-slate-50 transition-colors duration-300">
                    <div class="w-20 h-20 mx-auto bg-orange-100 text-orange-500 rounded-2xl flex items-center justify-center mb-6 shadow-sm">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">วิ่งได้อย่างอิสระ</h3>
                    <p class="text-slate-500">ไม่ต้องรอวันจัดงาน วิ่งที่สวนสาธารณะ ลู่วิ่ง หรือรอบหมู่บ้าน แล้วนำผลมาบันทึกได้ทุกเมื่อตลอดเวลา</p>
                </div>
                <div class="p-6 rounded-3xl hover:bg-slate-50 transition-colors duration-300">
                    <div class="w-20 h-20 mx-auto bg-red-100 text-red-500 rounded-2xl flex items-center justify-center mb-6 shadow-sm">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">อัปโหลดหลักฐานง่ายๆ</h3>
                    <p class="text-slate-500">รองรับภาพหน้าจอจากแอปพลิเคชันวิ่งที่คุณใช้งานประจำ เช่น Strava, Garmin Connect, Nike Run Club</p>
                </div>
                <div class="p-6 rounded-3xl hover:bg-slate-50 transition-colors duration-300">
                    <div class="w-20 h-20 mx-auto bg-indigo-100 text-indigo-500 rounded-2xl flex items-center justify-center mb-6 shadow-sm">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">ระบบจัดอันดับ Real-time</h3>
                    <p class="text-slate-500">ผลักดันตัวเองให้ไปได้ไกลขึ้น ด้วยระบบ Leaderboard ที่ให้คุณเช็คระยะทางแข่งขันกับเพื่อนนักวิ่งได้ทันที</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-slate-900 py-12 text-center text-slate-400">
        <p>© 2026 RunTracker Virtual Run. All rights reserved.</p>
    </footer>

</body>
</html>