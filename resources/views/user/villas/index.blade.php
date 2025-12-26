<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                    Cari Villa
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Filter villa sesuai preferensi Anda untuk mendapatkan rekomendasi terbaik
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Filter Section -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h3 class="text-xl font-semibold text-gray-900 mb-6">
                    <i class="fas fa-filter text-primary-600 mr-2"></i>
                    Filter Preferensi
                </h3>
                
                <form id="filterForm" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Rentang Harga -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-dollar-sign mr-1"></i>Rentang Harga
                            </label>
                            <div class="space-y-2">
                                <input type="number" id="minPrice" placeholder="Min" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                <input type="number" id="maxPrice" placeholder="Max" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            </div>
                            <div class="mt-2">
                                <input type="range" id="priceRange" min="0" max="5000000" step="100000" value="2500000" class="w-full">
                                <div class="flex justify-between text-xs text-gray-500 mt-1">
                                    <span>Rp 0</span>
                                    <span>Rp 5.000.000</span>
                                </div>
                            </div>
                        </div>

                        <!-- Jumlah Tamu -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-users mr-1"></i>Jumlah Tamu
                            </label>
                            <select id="capacity" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                <option value="">Semua</option>
                                <option value="2">1-2 Orang</option>
                                <option value="4">3-4 Orang</option>
                                <option value="6">5-6 Orang</option>
                                <option value="8">7-8 Orang</option>
                                <option value="10">9-10 Orang</option>
                                <option value="12">11+ Orang</option>
                            </select>
                        </div>

                        <!-- Lokasi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-map-marker-alt mr-1"></i>Lokasi
                            </label>
                            <select id="location" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                <option value="">Semua Lokasi</option>
                                <option value="Kaliurang">Kaliurang</option>
                                <option value="Prambanan">Prambanan</option>
                                <option value="Pakem">Pakem</option>
                                <option value="Ngaglik">Ngaglik</option>
                                <option value="Depok">Depok</option>
                            </select>
                        </div>

                        <!-- Fasilitas -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-swimming-pool mr-1"></i>Fasilitas
                            </label>
                            <div class="space-y-2 max-h-32 overflow-y-auto border border-gray-200 rounded-lg p-2">
                                <label class="flex items-center text-sm">
                                    <input type="checkbox" name="facilities[]" value="pool" class="mr-2">
                                    <span>Kolam Renang</span>
                                </label>
                                <label class="flex items-center text-sm">
                                    <input type="checkbox" name="facilities[]" value="wifi" class="mr-2">
                                    <span>WiFi</span>
                                </label>
                                <label class="flex items-center text-sm">
                                    <input type="checkbox" name="facilities[]" value="parking" class="mr-2">
                                    <span>Parkir</span>
                                </label>
                                <label class="flex items-center text-sm">
                                    <input type="checkbox" name="facilities[]" value="ac" class="mr-2">
                                    <span>AC</span>
                                </label>
                                <label class="flex items-center text-sm">
                                    <input type="checkbox" name="facilities[]" value="kitchen" class="mr-2">
                                    <span>Dapur</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                        <button type="button" onclick="resetFilters()" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                            <i class="fas fa-redo mr-2"></i>Reset
                        </button>
                        <button type="submit" class="px-8 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                            <i class="fas fa-search mr-2"></i>Proses Rekomendasi
                        </button>
                    </div>
                </form>
            </div>

            <!-- Info Card -->
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-600 mr-3 mt-1"></i>
                    <div>
                        <p class="text-sm text-blue-800">
                            <strong>Catatan:</strong> Filter ini digunakan untuk menyaring villa awal. 
                            Sistem akan menggunakan metode TOPSIS dengan bobot kriteria yang sudah ditentukan untuk memberikan ranking akhir.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Villa List -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-900">
                        <i class="fas fa-list text-primary-600 mr-2"></i>
                        Daftar Villa
                    </h3>
                    <div class="flex items-center space-x-3">
                        <span class="text-sm text-gray-600" id="villaCount">
                            Menampilkan {{ \App\Models\Villa::where('is_active', true)->count() }} villa
                        </span>
                        <select class="border border-gray-300 rounded-lg px-3 py-1 text-sm">
                            <option>Urutkan: Rekomendasi</option>
                            <option>Harga: Terendah</option>
                            <option>Harga: Tertinggi</option>
                            <option>Rating: Tertinggi</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="villaGrid">
                    @php
                        $villas = \App\Models\Villa::where('is_active', true)->paginate(9);
                    @endphp
                    
                    @forelse($villas as $villa)
                    <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition">
                        <div class="h-48 bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center relative">
                            <i class="fas fa-home text-primary-400 text-5xl"></i>
                            <button class="absolute top-2 right-2 bg-white p-2 rounded-full hover:bg-red-50 transition">
                                <i class="fas fa-heart text-gray-400 hover:text-red-500"></i>
                            </button>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-gray-900 mb-1">{{ $villa->name }}</h4>
                            <p class="text-sm text-gray-600 mb-2">
                                <i class="fas fa-map-marker-alt text-gray-400 mr-1"></i>
                                {{ Str::limit($villa->address, 35) }}
                            </p>
                            <div class="flex items-center mb-3">
                                <div class="flex text-yellow-400 mr-2">
                                    @for($i = 0; $i < 5; $i++)
                                    <i class="fas fa-star text-xs"></i>
                                    @endfor
                                </div>
                                <span class="text-xs text-gray-500">(4.5+)</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-primary-600">Rp {{ number_format($villa->price_per_night ?? 0, 0, ',', '.') }}</span>
                                <a href="{{ route('villa.detail', $villa->id) }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium">
                                    Detail <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-3 text-center py-12 text-gray-400">
                        <i class="fas fa-home text-5xl mb-4"></i>
                        <p class="text-lg">Tidak ada villa ditemukan</p>
                        <p class="text-sm mt-2">Coba ubah filter Anda</p>
                    </div>
                    @endforelse
                </div>

                @if($villas->hasPages())
                <div class="mt-6 flex justify-center">
                    {{ $villas->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.getElementById('filterForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Redirect to recommendations with filters
            const filters = {
                minPrice: document.getElementById('minPrice').value,
                maxPrice: document.getElementById('maxPrice').value,
                capacity: document.getElementById('capacity').value,
                location: document.getElementById('location').value,
                facilities: Array.from(document.querySelectorAll('input[name="facilities[]"]:checked')).map(cb => cb.value)
            };
            
            // Store filters and redirect
            sessionStorage.setItem('villaFilters', JSON.stringify(filters));
            window.location.href = '{{ route("user.recommendations.index") }}';
        });

        function resetFilters() {
            document.getElementById('filterForm').reset();
            document.getElementById('priceRange').value = 2500000;
        }

        // Price range slider
        document.getElementById('priceRange').addEventListener('input', function(e) {
            document.getElementById('maxPrice').value = e.target.value;
        });
    </script>
</x-app-layout>

