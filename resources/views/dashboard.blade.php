<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            🔥 {{ __('บันทึกการวิ่งวันนี้') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm">
                    <p class="font-bold">เยี่ยมมาก!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-8 py-6">
                    <h3 class="text-2xl font-bold text-white flex items-center">
                        <span class="mr-3 text-3xl">🏃‍♂️</span> ลุยเลย! บันทึกก้าวของคุณ
                    </h3>
                    <p class="text-blue-100 mt-1">ทุกก้าวคือความสำเร็จ กรอกข้อมูลการวิ่งของคุณสำหรับวันนี้</p>
                </div>
                
                <div class="p-8">
                    <form action="{{ route('runs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">📅 วันที่วิ่ง</label>
                                <input type="date" name="run_date" value="{{ date('Y-m-d') }}" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">📍 ระยะทาง (กิโลเมตร)</label>
                                <input type="number" step="0.01" name="distance" placeholder="เช่น 5.00" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors shadow-sm">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">📸 อัปโหลดภาพหลักฐาน (ไม่บังคับ)</label>
                            <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all cursor-pointer border border-gray-200 rounded-xl p-2 bg-gray-50">
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full flex justify-center items-center px-8 py-4 border border-transparent text-lg font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-300 shadow-lg transform transition hover:-translate-y-1">
                                💾 บันทึกความสำเร็จ
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                <div class="px-8 py-5 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <span class="mr-2 text-xl">📝</span> ประวัติการวิ่งของคุณ
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white border-b border-gray-100 text-gray-500 text-sm uppercase tracking-wider">
                                <th class="py-4 px-8 font-semibold">วันที่</th>
                                <th class="py-4 px-8 font-semibold">ระยะทาง (กม.)</th>
                                <th class="py-4 px-8 font-semibold text-center">หลักฐาน</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($runs as $run)
                            <tr class="hover:bg-indigo-50/50 transition-colors">
                                <td class="py-4 px-8 text-gray-800 font-medium">{{ $run->run_date }}</td>
                                <td class="py-4 px-8 text-indigo-600 font-bold text-lg">{{ number_format($run->distance, 2) }}</td>
                                <td class="py-4 px-8 text-center">
                                    @if($run->image_path)
                                        <a href="{{ asset('storage/' . $run->image_path) }}" target="_blank" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 hover:bg-blue-200 transition-colors">
                                            🖼️ ดูรูปภาพ
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="py-8 text-center text-gray-500">
                                    <div class="text-4xl mb-2 opacity-50">👟</div>
                                    <p>ยังไม่มีข้อมูลการวิ่ง มาเริ่มก้าวแรกกันเถอะ!</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>