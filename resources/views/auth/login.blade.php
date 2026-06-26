<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>เข้าสู่ระบบ - Run Tracker</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Kanit', sans-serif; }
    </style>
</head>
<body class="antialiased bg-gradient-to-br from-cyan-400 via-blue-500 to-indigo-600 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white rounded-[2rem] shadow-2xl overflow-hidden animate-fade-in-up">
        
        <div class="bg-indigo-50 p-8 text-center relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-32 h-32 bg-indigo-200 rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>
            <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-24 h-24 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>
            
            <div class="relative z-10 w-20 h-20 bg-white rounded-full flex items-center justify-center text-4xl shadow-md mx-auto mb-4 border-2 border-indigo-100 transform hover:scale-110 transition duration-300">
                👟
            </div>
            <h2 class="relative z-10 text-3xl font-extrabold text-gray-800">ยินดีต้อนรับกลับมา!</h2>
            <p class="relative z-10 text-gray-500 mt-2 font-medium">พร้อมที่จะออกไปลุยหรือยัง?</p>
        </div>

        <div class="p-8">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700">อีเมลของคุณ</label>
                    <input id="email" class="block mt-2 w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="runner@example.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-bold text-gray-700">รหัสผ่าน</label>
                    <input id="password" class="block mt-2 w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors shadow-sm" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
                </div>

                <div class="flex items-center justify-between mt-4">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 w-5 h-5 cursor-pointer" name="remember">
                        <span class="ms-2 text-sm text-gray-600 font-medium">จดจำฉันไว้</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 hover:text-indigo-800 font-bold transition-colors" href="{{ route('password.request') }}">
                            ลืมรหัสผ่าน?
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full py-4 mt-6 bg-gray-900 hover:bg-gray-800 text-white font-bold rounded-xl shadow-lg transition transform hover:-translate-y-1 text-lg">
                    🚀 เข้าสู่ระบบ
                </button>
            </form>

            <div class="mt-6 flex items-center justify-center space-x-4">
                <span class="h-px w-full bg-gray-200"></span>
                <span class="text-gray-400 text-sm font-medium">หรือ</span>
                <span class="h-px w-full bg-gray-200"></span>
            </div>

            <div class="mt-6">
                <a href="{{ route('google.redirect') }}" class="w-full flex items-center justify-center px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm bg-white hover:bg-gray-50 hover:border-gray-300 font-bold text-gray-700 transition transform hover:-translate-y-1 text-md">
                    <svg class="w-6 h-6 mr-3" viewBox="0 0 48 48">
                        <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
                        <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
                        <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
                        <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
                    </svg>
                    เข้าสู่ระบบด้วย Google
                </a>
            </div>
            
            @if (Route::has('register'))
                <div class="mt-8 text-center text-sm text-gray-600 font-medium">
                    ยังไม่มีบัญชีนักวิ่งใช่ไหม? 
                    <a href="{{ route('register') }}" class="font-bold text-indigo-600 hover:text-indigo-800 transition-colors">
                        สมัครสมาชิกฟรีที่นี่
                    </a>
                </div>
            @endif

        </div>
    </div>
</body>
</html>