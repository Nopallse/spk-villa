<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                    Detail Villa
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Informasi lengkap tentang villa pilihan Anda
                </p>
            </div>
            <div class="flex space-x-2">
                <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                    <i class="fas fa-heart mr-2"></i>Favorit
                </button>
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-share mr-2"></i>Share
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @php
                $villa = \App\Models\Villa::find($villaId ?? 1);
            @endphp

            @if($villa)
            <!-- Villa Header -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                <!-- Image Gallery -->
                <div class="relative">
                    <div class="h-96 bg-gray-200 flex items-center justify-center">
                        <i class="fas fa-home text-gray-400 text-8xl"></i>
                    </div>
                    <div class="absolute top-4 left-4">
                        <span class="bg-yellow-400 text-white px-3 py-1 rounded-full text-sm font-bold">
                            <i class="fas fa-trophy mr-1"></i>Rank #1
                        </span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <span class="bg-white text-primary-600 px-3 py-1 rounded-full text-sm font-bold">
                            TOPSIS: 0.847
                        </span>
                    </div>
                </div>

                <!-- Villa Info -->
                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-2">
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $villa->name }}</h1>
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400 mr-2">
                                    @for($i = 0; $i < 5; $i++)
                                    <i class="fas fa-star"></i>
                                    @endfor
                                </div>
                                <span class="text-gray-600 mr-4">(4.9) · 12 ulasan</span>
                                <i class="fas fa-map-marker-alt text-gray-400 mr-1"></i>
                                <span class="text-gray-600">{{ $villa->address }}</span>
                            </div>
                            
                            <div class="border-b border-gray-200 pb-6 mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">Deskripsi Villa</h3>
                                <p class="text-gray-700 leading-relaxed">
                                    {{ $villa->description ?? 'Villa dengan fasilitas lengkap dan lokasi strategis. Cocok untuk liburan keluarga atau gathering.' }}
                                </p>
                            </div>

                            <!-- Facilities -->
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Fasilitas Villa</h3>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-swimming-pool text-primary-600 mr-3"></i>
                                        <span class="text-gray-700">Kolam Renang</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-wifi text-primary-600 mr-3"></i>
                                        <span class="text-gray-700">WiFi Gratis</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-car text-primary-600 mr-3"></i>
                                        <span class="text-gray-700">Parkir Gratis</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-snowflake text-primary-600 mr-3"></i>
                                        <span class="text-gray-700">AC di Semua Kamar</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-utensils text-primary-600 mr-3"></i>
                                        <span class="text-gray-700">Dapur Lengkap</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-tv text-primary-600 mr-3"></i>
                                        <span class="text-gray-700">TV LED</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Booking Card -->
                        <div class="lg:col-span-1">
                            <div class="bg-gray-50 rounded-xl p-6 sticky top-8">
                                <div class="text-center mb-6">
                                    <div class="text-3xl font-bold text-primary-600 mb-2">Rp {{ number_format($villa->price_per_night ?? 0, 0, ',', '.') }}</div>
                                    <div class="text-gray-600">per malam</div>
                                    <div class="text-sm text-green-600 mt-1">
                                        <i class="fas fa-check mr-1"></i>Termasuk pajak
                                    </div>
                                </div>

                                <div class="space-y-4 mb-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Check-in</label>
                                        <input type="date" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Check-out</label>
                                        <input type="date" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Tamu</label>
                                        <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-500">
                                            @for($i = 1; $i <= 10; $i++)
                                            <option>{{ $i }} Tamu</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <button class="w-full bg-primary-600 text-white py-3 rounded-lg font-semibold hover:bg-primary-700 transition mb-4">
                                    Pesan Sekarang
                                </button>

                                <div class="border-t border-gray-200 pt-4 space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Harga per malam</span>
                                        <span class="text-gray-900">Rp {{ number_format($villa->price_per_night ?? 0, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between font-semibold text-lg">
                                        <span class="text-gray-900">Total</span>
                                        <span class="text-primary-600">Rp {{ number_format($villa->price_per_night ?? 0, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Info -->
                            <div class="bg-white rounded-xl p-6 mt-6 border">
                                <h3 class="font-semibold text-gray-900 mb-4">Informasi Cepat</h3>
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <i class="fas fa-users text-primary-600 mr-3"></i>
                                        <span class="text-gray-700">Kapasitas: {{ $villa->capacity ?? 'N/A' }} Orang</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-check text-primary-600 mr-3"></i>
                                        <span class="text-gray-700">Check-in: 15:00</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-times text-primary-600 mr-3"></i>
                                        <span class="text-gray-700">Check-out: 12:00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Why This Villa is Recommended -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h3 class="text-xl font-semibold text-gray-900 mb-6">
                    <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>
                    Mengapa Villa Ini Direkomendasikan?
                </h3>
                <p class="text-gray-700 mb-6">
                    Villa ini direkomendasikan berdasarkan perhitungan metode TOPSIS dengan bobot kriteria dari AHP. 
                    Berikut adalah nilai kontribusi setiap kriteria terhadap skor akhir:
                </p>
                
                @php
                    $criteria = \App\Models\Criteria::active()->ordered()->get();
                @endphp
                @if(count($criteria) > 0)
                <div class="space-y-4">
                    @foreach($criteria as $index => $criterion)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center">
                                <div class="bg-primary-100 p-2 rounded-full mr-3">
                                    <i class="fas fa-{{ ['dollar-sign', 'map-marker-alt', 'swimming-pool', 'sparkles', 'star', 'users'][$index % 6] }} text-primary-600"></i>
                        </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">{{ $criterion->name }}</h4>
                                    <p class="text-xs text-gray-500">Bobot: {{ $criterion->weight ? number_format($criterion->weight * 100, 2) : 'N/A' }}%</p>
                    </div>
                        </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-primary-600">8.5/10</div>
                                <p class="text-xs text-gray-500">Nilai Kriteria</p>
                    </div>
                        </div>
                        <div class="ml-12">
                            <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                                <div class="bg-primary-600 h-2 rounded-full" style="width: 85%"></div>
                    </div>
                            <p class="text-sm text-gray-600">
                                @if($criterion->name == 'Harga')
                                    Harga villa ini sangat kompetitif dan memberikan nilai terbaik untuk budget Anda.
                                @elseif($criterion->name == 'Lokasi')
                                    Lokasi strategis dengan akses mudah ke berbagai destinasi wisata dan fasilitas umum.
                                @elseif($criterion->name == 'Fasilitas')
                                    Fasilitas lengkap dan modern untuk kenyamanan maksimal selama menginap.
                                @elseif($criterion->name == 'Kebersihan')
                                    Tingkat kebersihan dan maintenance yang sangat baik.
                                @elseif($criterion->name == 'Rating')
                                    Rating tinggi dari tamu sebelumnya menunjukkan kepuasan yang konsisten.
                                @elseif($criterion->name == 'Kapasitas')
                                    Kapasitas sesuai untuk kebutuhan grup Anda.
                                @else
                                    Kriteria ini memberikan kontribusi positif terhadap skor akhir villa.
                                @endif
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="mt-6 p-6 bg-gradient-to-r from-primary-50 to-blue-50 rounded-lg border-2 border-primary-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm text-gray-600 mb-1">Skor Preferensi Akhir (Vi)</div>
                            <div class="text-4xl font-bold text-primary-600">0.847</div>
                            <div class="text-sm text-gray-600 mt-1">Ranking #1 dari {{ \App\Models\Villa::where('is_active', true)->count() }} villa</div>
                        </div>
                        <div class="text-right">
                            <div class="bg-yellow-400 text-white px-4 py-2 rounded-full font-bold text-sm mb-2">
                                ⭐ VILLA TERBAIK
                            </div>
                            <p class="text-xs text-gray-600">Berdasarkan TOPSIS</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            @else
            <!-- Villa Not Found -->
            <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                <i class="fas fa-exclamation-triangle text-yellow-400 text-5xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Villa Tidak Ditemukan</h3>
                <p class="text-gray-600 mb-4">Villa yang Anda cari tidak ditemukan atau sudah tidak tersedia.</p>
                <a href="{{ route('user.recommendations.index') }}" class="inline-block bg-primary-600 text-white px-6 py-2 rounded-lg hover:bg-primary-700 transition">
                    Kembali ke Rekomendasi
                </a>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex justify-between items-center bg-white rounded-xl shadow-lg p-6 mt-8">
                <a href="{{ route('user.recommendations.index') }}" class="flex items-center px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Hasil Rekomendasi
                </a>
                
                <div class="flex space-x-4">
                    <button class="px-6 py-3 border border-primary-600 text-primary-600 rounded-lg hover:bg-primary-50 transition">
                        <i class="fas fa-balance-scale mr-2"></i>
                        Bandingkan Villa
                    </button>
                    <button class="px-8 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                        <i class="fas fa-calendar-check mr-2"></i>
                        Pesan Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
