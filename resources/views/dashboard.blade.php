<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 tracking-tight flex items-center gap-2">
                <span>🏃‍♂️</span> Run Tracker Dashboard
            </h2>
            <span class="text-sm bg-orange-100 text-orange-700 font-semibold px-3 py-1 rounded-full border border-orange-200 shadow-sm">
                ฤดูกาลวิ่ง 2026
            </span>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            @if (session('success'))
                <div class="p-4 text-sm text-emerald-800 rounded-xl bg-emerald-50 border border-emerald-200 shadow-sm flex items-center gap-2 animate-fade-in" role="alert">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="p-4 text-sm text-rose-800 rounded-xl bg-rose-50 border border-rose-200 shadow-sm" role="alert">
                    <div class="flex items-center gap-2 mb-2 font-bold text-rose-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>พบข้อผิดพลาด กรุณาตรวจสอบข้อมูล:</span>
                    </div>
                    <ul class="list-disc list-inside space-y-1 text-rose-600 pl-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl shadow-md p-6 text-white relative overflow-hidden group">
                    <div class="absolute -right-6 -bottom-6 text-white opacity-10 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-36 " fill="currentColor" viewBox="0 0 24 24"><path d="M13.492 10.435a2.5 2.5 0 1 1-2.483-2.5 2.5 2.5 0 0 1 2.483 2.5zM22 12A10 10 0 1 1 12 2a10 10 0 0 1 10 10zm-3.55 3.73l-1.42-1.42a6.03 6.03 0 1 0-10.06 0l-1.42 1.42a8 8 0 1 1 12.9 0z"/></svg>
                    </div>
                    <p class="text-orange-100 text-sm font-medium uppercase tracking-wider">ระยะทางสะสมทั้งหมด</p>
                    <h3 class="text-4xl font-extrabold mt-2 tracking-tight">
                        {{ number_format($myTotalDistance, 2) }} <span class="text-xl font-normal text-orange-100">กม.</span>
                    </h3>
                    <div class="mt-4 text-xs text-orange-100 bg-white/10 w-fit px-2 py-1 rounded-md backdrop-blur-sm">
                        เป้าหมายถัดไปอยู่อีกไม่ไกล! ลุยต่อครับ
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6 flex flex-col justify-between">
                    <div>
                        <p class="text-slate-400 text-sm font-medium uppercase tracking-wider">จำนวนกิจกรรม</p>
                        <h3 class="text-3xl font-bold text-slate-800 mt-2">
                            {{ $myRuns->count() }} <span class="text-lg font-normal text-slate-400">ครั้ง</span>
                        </h3>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-100 text-xs text-slate-500 flex items-center gap-1">
                        <span class="text-emerald-500 font-bold">✓</span> บันทึกสม่ำเสมอช่วยสร้างวินัย
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6 flex flex-col justify-between">
                    <div>
                        <p class="text-slate-400 text-sm font-medium uppercase tracking-wider">อันดับของคุณในตาราง</p>
                        <h3 class="text-3xl font-bold text-slate-800 mt-2 flex items-center gap-2">
                            @php
                                $myRank = $leaderboard->search(fn($runner) => $runner->id === Auth::id()) !== false 
                                    ? $leaderboard->search(fn($runner) => $runner->id === Auth::id()) + 1 
                                    : '-';
                            @endphp
                            <span class="text-indigo-600 font-extrabold">#{{ $myRank }}</span>
                            <span class="text-base font-normal text-slate-400">จากนักวิ่งทั้งหมด</span>
                        </h3>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-100 text-xs text-slate-500">
                        อันดับอัปเดตแบบเรียลไทม์เมื่อมีการบันทึกผล
                    </div>
                </div>
            </div>

            <div x-data="{ activeTab: 'form' }" class="bg-white rounded-2xl shadow-sm border border-slate-200/60 p-6">
                
                <div class="border-b border-slate-100 mb-6">
                    <nav class="-mb-px flex space-x-6" aria-label="Tabs">
                        <button @click="activeTab = 'form'"
                                :class="activeTab === 'form' ? 'border-orange-500 text-orange-600 font-bold' : 'border-transparent text-slate-400 hover:text-slate-600 hover:border-slate-300'"
                                class="whitespace-nowrap py-4 px-2 border-b-2 font-medium text-base transition-all duration-200 flex items-center gap-2 focus:outline-none">
                            <span>📝</span> บันทึกผลการวิ่ง
                        </button>
                        
                        <button @click="activeTab = 'history'"
                                :class="activeTab === 'history' ? 'border-orange-500 text-orange-600 font-bold' : 'border-transparent text-slate-400 hover:text-slate-600 hover:border-slate-300'"
                                class="whitespace-nowrap py-4 px-2 border-b-2 font-medium text-base transition-all duration-200 flex items-center gap-2 focus:outline-none">
                            <span>🏃‍♂️</span> ประวัติของฉัน
                        </button>

                        <button @click="activeTab = 'leaderboard'"
                                :class="activeTab === 'leaderboard' ? 'border-orange-500 text-orange-600 font-bold' : 'border-transparent text-slate-400 hover:text-slate-600 hover:border-slate-300'"
                                class="whitespace-nowrap py-4 px-2 border-b-2 font-medium text-base transition-all duration-200 flex items-center gap-2 focus:outline-none">
                            <span>🏆</span> ตารางอันดับผู้เข้าแข่งขัน
                        </button>
                    </nav>
                </div>

                <div x-show="activeTab === 'form'" x-transition:enter="transition ease-out duration-200" class="max-w-xl mx-auto py-4">
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-slate-800">ส่งผลการวิ่งของคุณ</h3>
                        <p class="text-sm text-slate-400 mt-1">กรอกข้อมูลและส่งภาพหน้าจอจากแอปพลิเคชันวิ่ง (เช่น Strava, Garmin, Nike Run) เพื่อสะสมระยะทาง</p>
                    </div>

                    <form action="{{ route('runs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        
                        <div>
                            <label for="run_date" class="block text-sm font-semibold text-slate-700">วันที่ออกไปวิ่ง</label>
                            <input type="date" name="run_date" id="run_date" class="mt-1 block w-full border-slate-200 rounded-xl shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200/50 transition duration-150" required value="{{ date('Y-m-d') }}">
                        </div>

                        <div>
                            <label for="distance" class="block text-sm font-semibold text-slate-700">ระยะทางที่ได้ (กิโลเมตร)</label>
                            <div class="mt-1 relative rounded-xl shadow-sm">
                                <input type="number" step="0.01" name="distance" id="distance" placeholder="0.00" class="block w-full border-slate-200 pr-16 rounded-xl focus:border-orange-500 focus:ring focus:ring-orange-200/50 transition duration-150" required>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400 font-medium">
                                    กม.
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">ภาพถ่ายหลักฐาน / หน้าจอแอปวิ่ง</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-xl hover:border-orange-400 transition-colors duration-150 bg-slate-50/50">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-slate-600 justify-center">
                                        <label for="image" class="relative cursor-pointer bg-white rounded-md font-semibold text-orange-600 hover:text-orange-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-orange-500 px-1">
                                            <span>อัปโหลดไฟล์ภาพ</span>
                                            <input id="image" name="image" type="file" accept="image/*" class="sr-only" required>
                                        </label>
                                        <p class="pl-1">หรือลากไฟล์มาวางที่นี่</p>
                                    </div>
                                    <p class="text-xs text-slate-400">รองรับไฟล์ PNG, JPG, JPEG ขนาดไม่เกิน 5MB</p>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-base font-bold text-white bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transform active:scale-[0.98] transition-all duration-150">
                                🚀 บันทึกผลและอัปเดตสถิติ
                            </button>
                        </div>
                    </form>
                </div>

                <div x-show="activeTab === 'history'" style="display: none;" x-transition:enter="transition ease-out duration-200" class="py-2">
                    <div class="mb-4">
                        <h3 class="text-lg font-bold text-slate-800">รายการวิ่งย้อนหลังของคุณ</h3>
                        <p class="text-sm text-slate-400 mt-0.5">รวมประวัติการส่งผลทั้งหมด ตรวจสอบความถูกต้องและรูปภาพหลักฐานได้ที่นี่</p>
                    </div>

                    <div class="overflow-hidden border border-slate-100 rounded-xl shadow-inner">
                        <table class="w-full text-sm text-left text-slate-500">
                            <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-100 font-bold">
                                <tr>
                                    <th class="px-6 py-4">วันที่วิ่ง</th>
                                    <th class="px-6 py-4">ระยะทาง</th>
                                    <th class="px-6 py-4 text-center">หลักฐาน</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse ($myRuns as $run)
                                    <tr class="bg-white hover:bg-slate-50/80 transition-colors duration-100">
                                        <td class="px-6 py-4 font-medium text-slate-700">
                                            {{ \Carbon\Carbon::parse($run->run_date)->locale('th')->translatedFormat('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 font-bold text-lg text-slate-900">
                                            {{ number_format($run->distance, 2) }} <span class="text-xs font-normal text-slate-400">กม.</span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <a href="{{ asset('storage/' . $run->image_path) }}" target="_blank" class="inline-flex items-center gap-1 text-xs font-semibold px-3 py-1.5 bg-slate-100 text-slate-600 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition-colors duration-150">
                                                🔎 เปิดดูรูปภาพ
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-12 text-center text-slate-400">
                                            <p class="text-base font-medium">ยังไม่มีข้อมูลการวิ่งถูกบันทึกในระบบ</p>
                                            <p class="text-xs mt-1">กดที่แท็บ "บันทึกผลการวิ่ง" ด้านบนเพื่อเริ่มสะสมระยะทางชิ้นแรกของคุณ!</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div x-show="activeTab === 'leaderboard'" style="display: none;" x-transition:enter="transition ease-out duration-200" class="py-2">
                    <div class="mb-4">
                        <h3 class="text-lg font-bold text-slate-800">ทำเนียบนักวิ่งสูงสุด (Leaderboard)</h3>
                        <p class="text-sm text-slate-400 mt-0.5">รวมพลังท้าทายขีดจำกัดไปกับเพื่อนๆ เช็คอันดับและระยะทางสะสมของทุกคนในสัปดาห์นี้</p>
                    </div>

                    <div class="overflow-hidden border border-orange-100 rounded-xl shadow-sm">
                        <table class="w-full text-sm text-left text-slate-500">
                            <thead class="text-xs text-slate-800 bg-orange-50 border-b border-orange-100 font-bold">
                                <tr>
                                    <th class="px-6 py-4 text-center w-24">อันดับ</th>
                                    <th class="px-6 py-4">นักวิ่ง</th>
                                    <th class="px-6 py-4 text-right">ระยะทางรวม</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach ($leaderboard as $index => $runner)
                                    @php
                                        $isCurrentUser = $runner->id === Auth::id();
                                    @endphp
                                    <tr class="{{ $isCurrentUser ? 'bg-orange-50/50 font-semibold' : 'bg-white' }} hover:bg-slate-50 transition-colors duration-100">
                                        <td class="px-6 py-4 text-center text-xl">
                                            @if($index == 0)
                                                <span class="inline-block animate-bounce duration-1000">🥇</span>
                                            @elseif($index == 1)
                                                <span>🥈</span>
                                            @elseif($index == 2)
                                                <span>🥉</span>
                                            @else
                                                <span class="text-sm font-bold text-slate-400">{{ $index + 1 }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <span class="text-slate-800 font-medium">{{ $runner->name }}</span>
                                                @if($isCurrentUser)
                                                    <span class="text-[10px] bg-orange-600 text-white font-extrabold px-1.5 py-0.5 rounded-md uppercase tracking-wider shadow-sm">คุณ</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <span class="font-extrabold text-base text-slate-900">
                                                {{ number_format($runner->runs_sum_distance ?? 0, 2) }}
                                            </span>
                                            <span class="text-xs text-slate-400 font-normal pl-1">กม.</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>