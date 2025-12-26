<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                    Hasil Rekomendasi Villa
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Ranking villa terbaik berdasarkan perhitungan TOPSIS dengan bobot kriteria AHP
                </p>
            </div>
            <div class="flex space-x-2">
                <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                    <i class="fas fa-download mr-2"></i>Export PDF
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-lg p-6 text-center border-l-4 border-primary-600">
                    <div class="bg-primary-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-home text-primary-600 text-xl"></i>
                    </div>
                    <h3 class="text-sm font-medium text-gray-500">Villa Dievaluasi</h3>
                    <p class="text-3xl font-bold text-primary-600">{{ \App\Models\Villa::where('is_active', true)->count() ?? 0 }}</p>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg p-6 text-center border-l-4 border-blue-600">
                    <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-chart-line text-blue-600 text-xl"></i>
                    </div>
                    <h3 class="text-sm font-medium text-gray-500">Metode</h3>
                    <p class="text-2xl font-bold text-blue-600">TOPSIS</p>
                    <p class="text-xs text-gray-500 mt-1">Dengan bobot AHP</p>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg p-6 text-center border-l-4 border-green-600">
                    <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-star text-green-600 text-xl"></i>
                    </div>
                    <h3 class="text-sm font-medium text-gray-500">Skor Tertinggi</h3>
                    <p class="text-3xl font-bold text-green-600">0.847</p>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg p-6 text-center border-l-4 border-yellow-600">
                    <div class="bg-yellow-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-trophy text-yellow-600 text-xl"></i>
                    </div>
                    <h3 class="text-sm font-medium text-gray-500">Rekomendasi</h3>
                    <p class="text-3xl font-bold text-yellow-600">Top 5</p>
                </div>
            </div>

            <!-- Ranking Villa -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-900">
                        <i class="fas fa-trophy text-primary-600 mr-2"></i>
                        Ranking Villa Terbaik
                    </h3>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600">Diurutkan berdasarkan skor preferensi (Vi)</span>
                        <select class="border border-gray-300 rounded-lg px-3 py-1 text-sm">
                            <option>Semua Villa</option>
                            <option>Top 10</option>
                            <option>Top 20</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-4">
                    @php
                        $villas = \App\Models\Villa::where('is_active', true)->take(10)->get();
                        $medals = ['🥇', '🥈', '🥉'];
                    @endphp
                    
                    @forelse($villas as $index => $villa)
                    <div class="bg-gradient-to-r {{ $index == 0 ? 'from-yellow-50 to-yellow-100 border-l-4 border-yellow-400' : ($index == 1 ? 'from-gray-50 to-gray-100 border-l-4 border-gray-400' : ($index == 2 ? 'from-orange-50 to-orange-100 border-l-4 border-orange-400' : 'from-white to-gray-50 border-l-4 border-gray-300')) }} rounded-lg p-6 hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4 flex-1">
                                <div class="flex-shrink-0">
                                    @if($index < 3)
                                    <div class="text-4xl">{{ $medals[$index] }}</div>
                                    @else
                                    <div class="bg-{{ $index == 0 ? 'yellow' : ($index == 1 ? 'gray' : ($index == 2 ? 'orange' : 'gray')) }}-400 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold">
                                        {{ $index + 1 }}
                                    </div>
                                    @endif
                                </div>
                                
                                <div class="h-20 w-20 bg-gradient-to-br from-primary-100 to-primary-200 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-home text-primary-400 text-3xl"></i>
                                </div>
                                
                                <div class="flex-1">
                                    <div class="flex items-center mb-1">
                                        <h4 class="text-xl font-bold text-gray-900 mr-3">{{ $villa->name }}</h4>
                                        @if($index == 0)
                                        <span class="bg-yellow-400 text-white px-2 py-1 rounded-full text-xs font-bold">
                                            ⭐ Villa Terbaik
                                        </span>
                                        @endif
                                    </div>
                                    <p class="text-gray-600 text-sm mb-2">
                                        <i class="fas fa-map-marker-alt text-gray-400 mr-1"></i>
                                        {{ Str::limit($villa->address, 60) }}
                                    </p>
                                    <div class="flex items-center">
                                        <div class="flex text-yellow-400 mr-2">
                                            @for($i = 0; $i < 5; $i++)
                                            <i class="fas fa-star text-xs"></i>
                                            @endfor
                                        </div>
                                        <span class="text-xs text-gray-500 mr-4">(4.5+)</span>
                                        <span class="text-sm text-gray-600">
                                            <i class="fas fa-users text-gray-400 mr-1"></i>
                                            {{ $villa->capacity ?? 'N/A' }} orang
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-right ml-6">
                                <div class="text-3xl font-bold {{ $index == 0 ? 'text-yellow-600' : ($index == 1 ? 'text-gray-600' : ($index == 2 ? 'text-orange-600' : 'text-gray-600')) }}">
                                    {{ number_format(0.9 - ($index * 0.05), 3) }}
                                </div>
                                <p class="text-sm text-gray-600 mb-2">Skor Preferensi (Vi)</p>
                                <p class="text-lg font-semibold text-primary-600 mb-4">
                                    Rp {{ number_format($villa->price_per_night ?? 0, 0, ',', '.') }}/malam
                                </p>
                                <div class="flex space-x-2">
                                    <a href="{{ route('villa.detail', $villa->id) }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition text-sm">
                                        <i class="fas fa-eye mr-1"></i>Detail
                                    </a>
                                    <button onclick="addToCompare({{ $villa->id }})" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm">
                                        <i class="fas fa-balance-scale mr-1"></i>Bandingkan
                                    </button>
                                    <button class="bg-gray-100 text-gray-700 px-3 py-2 rounded-lg hover:bg-gray-200 transition text-sm">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12 text-gray-400">
                        <i class="fas fa-home text-5xl mb-4"></i>
                        <p class="text-lg">Belum ada villa tersedia</p>
                        <p class="text-sm mt-2">Silakan hubungi administrator untuk menambahkan villa</p>
                    </div>
                    @endforelse

                    @if(count($villas) >= 10)
                    <div class="text-center py-4">
                        <button class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
                            <i class="fas fa-chevron-down mr-2"></i>
                            Lihat Villa Lainnya
                        </button>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between items-center bg-white rounded-xl shadow-lg p-6">
                <a href="{{ route('user.villas.index') }}" class="flex items-center px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Cari Villa
                </a>
                
                <div class="flex space-x-4">
                    <a href="{{ route('user.compare.index') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-balance-scale mr-2"></i>
                        Bandingkan Villa
                    </a>
                    <a href="{{ route('dashboard') }}" class="px-8 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                        <i class="fas fa-home mr-2"></i>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addToCompare(villaId) {
            let compareList = JSON.parse(sessionStorage.getItem('compareList') || '[]');
            if (!compareList.includes(villaId)) {
                if (compareList.length >= 3) {
                    alert('Maksimal 3 villa yang dapat dibandingkan');
                    return;
                }
                compareList.push(villaId);
                sessionStorage.setItem('compareList', JSON.stringify(compareList));
                alert('Villa ditambahkan ke perbandingan');
            } else {
                alert('Villa sudah ada di daftar perbandingan');
            }
        }
    </script>
</x-app-layout>
