<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                    Beranda
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Temukan villa terbaik sesuai kebutuhan Anda
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Hero Section -->
            <div class="bg-gradient-to-r from-primary-600 to-primary-500 rounded-2xl p-12 text-white shadow-2xl relative overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full -mr-32 -mt-32"></div>
                    <div class="absolute bottom-0 left-0 w-96 h-96 bg-white rounded-full -ml-48 -mb-48"></div>
                </div>
                <div class="relative z-10">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">
                        Temukan Villa Terbaik<br>
                        <span class="text-yellow-300">Sesuai Kebutuhan Anda</span>
                    </h1>
                    <p class="text-xl text-primary-100 mb-8 max-w-2xl">
                        Sistem rekomendasi villa menggunakan metode TOPSIS dengan bobot kriteria yang ditentukan oleh ahli untuk memberikan rekomendasi terbaik untuk Anda.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('user.villas.index') }}" class="bg-white text-primary-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition text-center">
                            <i class="fas fa-search mr-2"></i>Cari Rekomendasi Villa
                        </a>
                        <a href="{{ route('user.about.index') }}" class="bg-white bg-opacity-20 text-white px-8 py-3 rounded-lg font-semibold hover:bg-opacity-30 transition text-center border-2 border-white">
                            <i class="fas fa-info-circle mr-2"></i>Pelajari Sistem
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-primary-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Villa</p>
                            <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Villa::where('is_active', true)->count() ?? 0 }}</p>
                            <p class="text-sm text-green-600 mt-1">
                                <i class="fas fa-check-circle mr-1"></i>Tersedia
                            </p>
                        </div>
                        <div class="bg-primary-100 p-3 rounded-full">
                            <i class="fas fa-home text-primary-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Kriteria</p>
                            <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Criteria::where('is_active', true)->count() ?? 0 }}</p>
                            <p class="text-sm text-blue-600 mt-1">
                                <i class="fas fa-list mr-1"></i>Penilaian
                            </p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i class="fas fa-list text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Metode</p>
                            <p class="text-3xl font-bold text-gray-900">TOPSIS</p>
                            <p class="text-sm text-green-600 mt-1">
                                <i class="fas fa-calculator mr-1"></i>Terpercaya
                            </p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <i class="fas fa-chart-line text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Bobot</p>
                            <p class="text-3xl font-bold text-gray-900">AHP</p>
                            <p class="text-sm text-yellow-600 mt-1">
                                <i class="fas fa-balance-scale mr-1"></i>Ditentukan ahli
                            </p>
                        </div>
                        <div class="bg-yellow-100 p-3 rounded-full">
                            <i class="fas fa-balance-scale text-yellow-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rekomendasi Teratas Minggu Ini -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">
                            <i class="fas fa-fire text-orange-600 mr-2"></i>
                            Rekomendasi Teratas Minggu Ini
                        </h3>
                        <p class="text-gray-600 mt-1">Villa terbaik berdasarkan perhitungan sistem</p>
                    </div>
                    <a href="{{ route('user.recommendations.index') }}" class="text-primary-600 hover:text-primary-700 text-sm font-semibold">
                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @php
                        $topVillas = \App\Models\Villa::where('is_active', true)->take(3)->get();
                    @endphp
                    
                    @forelse($topVillas as $index => $villa)
                    <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300 {{ $index == 0 ? 'ring-2 ring-yellow-400' : '' }}">
                        @if($index == 0)
                        <div class="bg-yellow-400 text-white text-center py-1 text-xs font-bold">
                            ⭐ VILLA TERBAIK
                        </div>
                        @endif
                        <div class="h-48 bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center relative">
                            <i class="fas fa-home text-primary-400 text-6xl"></i>
                            @if($index == 0)
                            <div class="absolute top-2 left-2 bg-yellow-400 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold text-lg">
                                1
                            </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-gray-900 mb-1 text-lg">{{ $villa->name }}</h4>
                            <p class="text-sm text-gray-600 mb-3">{{ Str::limit($villa->address, 40) }}</p>
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center">
                                    <div class="flex text-yellow-400 mr-2">
                                        @for($i = 0; $i < 5; $i++)
                                        <i class="fas fa-star text-xs"></i>
                                        @endfor
                                    </div>
                                    <span class="text-xs text-gray-500">(4.5+)</span>
                                </div>
                                <span class="text-lg font-bold text-primary-600">Rp {{ number_format($villa->price_per_night ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('villa.detail', $villa->id) }}" class="flex-1 bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition text-sm text-center">
                                    <i class="fas fa-eye mr-1"></i>Detail
                                </a>
                                <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition text-sm">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-3 text-center py-12 text-gray-400">
                        <i class="fas fa-home text-5xl mb-4"></i>
                        <p class="text-lg">Belum ada villa tersedia</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Penjelasan Singkat Sistem -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-8">
                <div class="text-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">
                        <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>
                        Bagaimana Sistem Bekerja?
                    </h3>
                    <p class="text-gray-600">Sistem menggunakan metode ilmiah untuk memberikan rekomendasi terbaik</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white rounded-lg p-6 shadow-md">
                        <div class="flex items-center mb-4">
                            <div class="bg-primary-100 p-3 rounded-full mr-4">
                                <i class="fas fa-balance-scale text-primary-600 text-xl"></i>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900">Metode AHP</h4>
                        </div>
                        <p class="text-gray-600 text-sm">
                            Bobot kriteria ditentukan oleh ahli melalui perbandingan berpasangan menggunakan metode Analytical Hierarchy Process (AHP).
                        </p>
                    </div>
                    
                    <div class="bg-white rounded-lg p-6 shadow-md">
                        <div class="flex items-center mb-4">
                            <div class="bg-green-100 p-3 rounded-full mr-4">
                                <i class="fas fa-chart-line text-green-600 text-xl"></i>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900">Metode TOPSIS</h4>
                        </div>
                        <p class="text-gray-600 text-sm">
                            Villa diurutkan menggunakan metode TOPSIS berdasarkan kedekatan dengan solusi ideal positif dan jauh dari solusi ideal negatif.
                        </p>
                    </div>
                </div>
                
                <div class="text-center mt-6">
                    <a href="{{ route('user.about.index') }}" class="inline-block bg-primary-600 text-white px-6 py-2 rounded-lg hover:bg-primary-700 transition">
                        <i class="fas fa-book mr-2"></i>Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
