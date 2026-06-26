<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Run Tracker - บันทึกการวิ่งของคุณ</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-800 selection:bg-indigo-500 selection:text-white flex items-center justify-center min-h-screen">
    
    <div class="max-w-4xl mx-auto px-6 py-16 text-center">
        <div class="mb-8 flex justify-center">
            <div class="w-24 h-24 bg-indigo-600 rounded-full flex items-center justify-center text-5xl shadow-xl transform hover:scale-110 transition duration-300">
                🏃
            </div>
        </div>

        <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-gray-900 mb-6">
            ยินดีต้อนรับสู่ <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">Run Tracker</span>
        </h1>
        
        <p class="text-xl text-gray-600 mb-12 max-w-2xl mx-auto leading-relaxed">
            แอปพลิเคชันบันทึกระยะทางวิ่งที่ใช้งานง่ายที่สุด ติดตามความก้าวหน้าของคุณ และท้าทายขีดจำกัดไปพร้อมกับเพื่อนๆ ในทำเนียบตารางอันดับ
        </p>

        <div class="flex justify-center items-center">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 text-lg flex items-center gap-2">
                        เข้าสู่หน้า Dashboard 🚀
                    </a>
                @else
                    <a href="{{ route('google.redirect') }}" class="px-8 py-4 bg-white border border-gray-200 hover:bg-gray-50 text-gray-800 font-bold rounded-2xl shadow-md hover:shadow-lg transition transform hover:-translate-y-1 text-lg flex items-center gap-3">
                        <svg class="w-6 h-6" viewBox="0 0 48 48">
                            <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
                            <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
                            <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
                            <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
                        </svg>
                        เข้าสู่ระบบด้วย Google
                    </a>
                @endauth
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-24 border-t border-gray-200 pt-16">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="text-4xl mb-4">📝</div>
                <h3 class="font-bold text-gray-800 text-lg mb-2">บันทึกง่าย รวดเร็ว</h3>
                <p class="text-gray-500 text-sm">กรอกข้อมูลระยะทางรายวัน พร้อมอัปโหลดภาพหลักฐานได้อย่างสะดวกรวดเร็ว</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="text-4xl mb-4">🏆</div>
                <h3 class="font-bold text-gray-800 text-lg mb-2">แข่งขันบนตารางอันดับ</h3>
                <p class="text-gray-500 text-sm">จัดอันดับระยะทางรวม แข่งขันกับนักวิ่งคนอื่นๆ เพื่อสร้างแรงบันดาลใจ</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="text-4xl mb-4">📱</div>
                <h3 class="font-bold text-gray-800 text-lg mb-2">รองรับทุกอุปกรณ์</h3>
                <p class="text-gray-500 text-sm">ออกแบบมาให้ใช้งานได้ดีทั้งบนสมาร์ทโฟน แท็บเล็ต และคอมพิวเตอร์</p>
            </div>
        </div>
        
    </div>
</body>
</html>