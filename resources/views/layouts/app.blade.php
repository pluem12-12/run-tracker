<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🏃</text></svg>">

        <title>{{ config('app.name', 'Run Tracker') }} - แทร็กเกอร์ของคนรักสุขภาพ</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Kanit', sans-serif !important;
            }
            /* ปรับแต่ง Scrollbar ให้ดูโมเดิร์นแบบแอปมือถือ */
            ::-webkit-scrollbar {
                width: 8px;
            }
            ::-webkit-scrollbar-track {
                background: #f1f1f1; 
            }
            ::-webkit-scrollbar-thumb {
                background: #c7c7cc; 
                border-radius: 10px;
            }
            ::-webkit-scrollbar-thumb:hover {
                background: #a1a1aa; 
            }
        </style>
    </head>
    <body class="antialiased bg-slate-50 text-slate-800 selection:bg-indigo-500 selection:text-white">
        <div class="min-h-screen">
            
            @include('layouts.navigation')

            @if (isset($header))
                <header class="bg-white shadow-sm border-b border-slate-200 sticky top-0 z-10">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main class="animate-fade-in-up">
                {{ $slot }}
            </main>
            
        </div>
    </body>
</html>