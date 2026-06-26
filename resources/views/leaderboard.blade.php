<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            🏆 {{ __('ตารางอันดับนักวิ่ง (Leaderboard)') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="relative bg-gradient-to-br from-indigo-600 via-purple-600 to-fuchsia-500 rounded-3xl shadow-2xl p-10 overflow-hidden text-white">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white opacity-10 rounded-full blur-2xl"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-center">
                    <div>
                        <p class="text-indigo-100 font-medium text-lg mb-1 tracking-wide uppercase">ระยะทางวิ่งสะสมของคุณ</p>
                        <div class="flex items-baseline space-x-2 mt-2">
                            <h3 class="text-6xl md:text-7xl font-extrabold tracking-tight drop-shadow-md">{{ number_format($myTotalDistance, 2) }}</h3>
                            <span class="text-2xl font-medium text-indigo-100">กิโลเมตร</span>
                        </div>
                        <p class="mt-4 text-md text-indigo-100 flex items-center font-semibold">
                            <span class="mr-2 text-yellow-300">⭐</span> ยอดเยี่ยมมาก! รักษาสถิติต่อไปนะ
                        </p>
                    </div>
                    <div class="mt-8 md:mt-0 text-8xl md:text-9xl drop-shadow-2xl transform hover:scale-110 transition-transform cursor-default">
                        🏃‍♂️
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                <div class="bg-white px-8 py-6 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-2xl font-bold text-gray-800 flex items-center">
                        <span class="mr-3 text-3xl">🏅</span> ทำเนียบยอดมนุษย์นักวิ่ง
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 text-gray-500 text-sm uppercase tracking-wider">
                                <th class="py-5 px-6 font-bold text-center w-28">อันดับ</th>
                                <th class="py-5 px-6 font-bold">นักวิ่ง</th>
                                <th class="py-5 px-6 font-bold text-right pr-10">ระยะทางรวม</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($users as $index => $user)
                            @php
                                $isMe = $user->id == auth()->id();
                            @endphp
                            <tr class="{{ $isMe ? 'bg-indigo-50/80' : 'hover:bg-gray-50' }} transition duration-200">
                                
                                <td class="py-5 px-6 text-center">
                                    @if($index == 0) 
                                        <div class="w-12 h-12 mx-auto bg-gradient-to-br from-yellow-200 to-yellow-400 rounded-full flex items-center justify-center text-2xl shadow-md border-2 border-yellow-100">🥇</div>
                                    @elseif($index == 1) 
                                        <div class="w-12 h-12 mx-auto bg-gradient-to-br from-gray-200 to-gray-400 rounded-full flex items-center justify-center text-2xl shadow-md border-2 border-gray-100">🥈</div>
                                    @elseif($index == 2) 
                                        <div class="w-12 h-12 mx-auto bg-gradient-to-br from-orange-200 to-orange-400 rounded-full flex items-center justify-center text-2xl shadow-md border-2 border-orange-100">🥉</div>
                                    @else 
                                        <div class="w-10 h-10 mx-auto rounded-full flex items-center justify-center text-lg font-bold text-gray-500 bg-gray-100">
                                            {{ $index + 1 }}
                                        </div>
                                    @endif
                                </td>
                                
                                <td class="py-5 px-6">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 text-white flex items-center justify-center font-bold text-lg mr-4 shadow-md uppercase">
                                            {{ mb_substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-lg {{ $isMe ? 'text-indigo-700 font-extrabold' : 'text-gray-800 font-bold' }}">
                                                {{ $user->name }}
                                            </p>
                                            @if($isMe)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-bold bg-indigo-100 text-indigo-800 mt-1">
                                                    บัญชีของคุณ
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                
                                <td class="py-5 px-6 text-right pr-10">
                                    <div class="inline-flex items-baseline space-x-1">
                                        <span class="text-2xl {{ $isMe ? 'text-indigo-700 font-black' : 'text-gray-700 font-bold' }}">
                                            {{ number_format($user->runs_sum_distance, 2) }}
                                        </span>
                                        <span class="text-sm {{ $isMe ? 'text-indigo-500' : 'text-gray-500' }} font-medium">กม.</span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>