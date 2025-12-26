<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                    Riwayat Rekomendasi
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Jejak penggunaan sistem SPK Anda
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @php
                // In real app, this would come from database
                $histories = []; // Will be populated from calculation_history table
            @endphp

            @if(count($histories) > 0)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-900">
                        <i class="fas fa-history text-primary-600 mr-2"></i>
                        Riwayat Pencarian ({{ count($histories) }})
                    </h3>
                    <select class="border border-gray-300 rounded-lg px-3 py-1 text-sm">
                        <option>Semua</option>
                        <option>Minggu ini</option>
                        <option>Bulan ini</option>
                        <option>Tahun ini</option>
                    </select>
                </div>

                <div class="space-y-4">
                    @foreach($histories as $history)
                    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center mb-3">
                                    <div class="bg-primary-100 p-2 rounded-full mr-3">
                                        <i class="fas fa-calendar text-primary-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">{{ $history->created_at->format('d F Y, H:i') }}</h4>
                                        <p class="text-sm text-gray-500">{{ $history->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                
                                <div class="ml-12 space-y-2">
                                    <div>
                                        <span class="text-sm font-medium text-gray-700">Filter yang digunakan:</span>
                                        <div class="flex flex-wrap gap-2 mt-1">
                                            @if($history->min_price)
                                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">Harga: Rp {{ number_format($history->min_price, 0, ',', '.') }}</span>
                                            @endif
                                            @if($history->capacity)
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Kapasitas: {{ $history->capacity }} orang</span>
                                            @endif
                                            @if($history->location)
                                            <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-xs">Lokasi: {{ $history->location }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <span class="text-sm font-medium text-gray-700">Villa Terbaik:</span>
                                        <div class="mt-1">
                                            <span class="text-yellow-500 text-lg mr-2">🥇</span>
                                            <span class="font-semibold text-gray-900">{{ $history->top_villa_name ?? 'N/A' }}</span>
                                            <span class="text-sm text-gray-600 ml-2">(Skor: {{ $history->top_score ?? 'N/A' }})</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="ml-4">
                                <a href="{{ route('user.recommendations.index') }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium">
                                    Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <div class="max-w-md mx-auto">
                    <i class="fas fa-history text-gray-300 text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Riwayat</h3>
                    <p class="text-gray-600 mb-6">
                        Anda belum melakukan pencarian rekomendasi villa. Mulai cari villa sekarang!
                    </p>
                    <a href="{{ route('user.villas.index') }}" class="inline-block bg-primary-600 text-white px-6 py-2 rounded-lg hover:bg-primary-700 transition">
                        <i class="fas fa-search mr-2"></i>Cari Villa Sekarang
                    </a>
                </div>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex justify-between items-center bg-white rounded-xl shadow-lg p-6 mt-8">
                <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

