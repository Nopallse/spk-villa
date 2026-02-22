<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                    Cari Villa
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Filter villa sesuai preferensi Anda untuk mendapatkan rekomendasi terbaik dengan metode TOPSIS
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
                
                <form id="filterForm" method="GET" action="{{ route('user.villas.index') }}" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Rentang Harga -->
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-dollar-sign mr-1"></i>Rentang Harga
                            </label>
                            <div class="grid grid-cols-2 gap-3 mb-3">
                                <div>
                                    <label class="block text-xs text-gray-500 mb-1">Minimum</label>
                                    <input type="number" name="min_price" id="minPrice" placeholder="Min (Rp)" 
                                        value="{{ $filters['min_price'] ?? '' }}"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-500 mb-1">Maksimum</label>
                                    <input type="number" name="max_price" id="maxPrice" placeholder="Max (Rp)" 
                                        value="{{ $filters['max_price'] ?? '' }}"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                            </div>
                            <!-- Dual Range Slider -->
                            <div class="relative pt-1">
                                <div class="flex justify-between text-xs text-gray-500 mb-2">
                                    <span id="minPriceDisplay">Rp {{ number_format($filters['min_price'] ?? 0, 0, ',', '.') }}</span>
                                    <span id="maxPriceDisplay">Rp {{ number_format($filters['max_price'] ?? 2000000, 0, ',', '.') }}</span>
                                </div>
                                <div class="relative h-2">
                                    <div class="absolute w-full h-2 bg-gray-200 rounded"></div>
                                    <div id="priceRangeTrack" class="absolute h-2 bg-primary-500 rounded"></div>
                                    <input type="range" id="minPriceRange" min="0" max="2000000" step="50000" 
                                        value="{{ $filters['min_price'] ?? 0 }}" 
                                        class="absolute w-full h-2 appearance-none bg-transparent pointer-events-none [&::-webkit-slider-thumb]:pointer-events-auto [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:w-4 [&::-webkit-slider-thumb]:h-4 [&::-webkit-slider-thumb]:bg-primary-600 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:cursor-pointer [&::-webkit-slider-thumb]:shadow-md [&::-moz-range-thumb]:pointer-events-auto [&::-moz-range-thumb]:w-4 [&::-moz-range-thumb]:h-4 [&::-moz-range-thumb]:bg-primary-600 [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:cursor-pointer [&::-moz-range-thumb]:border-0">
                                    <input type="range" id="maxPriceRange" min="0" max="2000000" step="50000" 
                                        value="{{ $filters['max_price'] ?? 2000000 }}" 
                                        class="absolute w-full h-2 appearance-none bg-transparent pointer-events-none [&::-webkit-slider-thumb]:pointer-events-auto [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:w-4 [&::-webkit-slider-thumb]:h-4 [&::-webkit-slider-thumb]:bg-primary-600 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:cursor-pointer [&::-webkit-slider-thumb]:shadow-md [&::-moz-range-thumb]:pointer-events-auto [&::-moz-range-thumb]:w-4 [&::-moz-range-thumb]:h-4 [&::-moz-range-thumb]:bg-primary-600 [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:cursor-pointer [&::-moz-range-thumb]:border-0">
                                </div>
                                <div class="flex justify-between text-xs text-gray-400 mt-2">
                                    <span>Rp 0</span>
                                    <span>Rp 2.000.000</span>
                                </div>
                            </div>
                        </div>

                        <!-- Jumlah Tamu -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-users mr-1"></i>Jumlah Tamu
                            </label>
                            <select name="capacity" id="capacity" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                <option value="">Semua</option>
                                <option value="2" {{ ($filters['capacity'] ?? '') == '2' ? 'selected' : '' }}>1-2 Orang</option>
                                <option value="4" {{ ($filters['capacity'] ?? '') == '4' ? 'selected' : '' }}>3-4 Orang</option>
                                <option value="6" {{ ($filters['capacity'] ?? '') == '6' ? 'selected' : '' }}>5-6 Orang</option>
                                <option value="8" {{ ($filters['capacity'] ?? '') == '8' ? 'selected' : '' }}>7-8 Orang</option>
                                <option value="10" {{ ($filters['capacity'] ?? '') == '10' ? 'selected' : '' }}>9-10 Orang</option>
                                <option value="12" {{ ($filters['capacity'] ?? '') == '12' ? 'selected' : '' }}>11+ Orang</option>
                            </select>
                        </div>

                        <!-- Fasilitas -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-swimming-pool mr-1"></i>Fasilitas
                            </label>
                            <div class="space-y-2 max-h-32 overflow-y-auto border border-gray-200 rounded-lg p-2">
                                @php
                                    $facilityOptions = [
                                        'Swimming Pool' => 'Kolam Renang',
                                        'WiFi' => 'WiFi',
                                        'Parking' => 'Parkir',
                                        'Air Conditioning' => 'AC',
                                        'Kitchen' => 'Dapur',
                                        'Garden' => 'Taman',
                                        'BBQ' => 'BBQ Area',
                                    ];
                                    $selectedFacilities = $filters['facilities'] ?? [];
                                @endphp
                                @foreach($facilityOptions as $key => $label)
                                <label class="flex items-center text-sm">
                                    <input type="checkbox" name="facilities[]" value="{{ $key }}" 
                                        {{ in_array($key, $selectedFacilities) ? 'checked' : '' }}
                                        class="mr-2 rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                                    <span>{{ $label }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                        <div class="text-sm text-gray-600">
                            <span id="filterInfo">
                                @if(!empty($filters['min_price']) || !empty($filters['max_price']) || !empty($filters['capacity']) || !empty($filters['facilities']))
                                    <i class="fas fa-info-circle mr-1"></i>Filter aktif diterapkan
                                @endif
                            </span>
                        </div>
                        <div class="flex space-x-4">
                            <a href="{{ route('user.villas.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                                <i class="fas fa-redo mr-2"></i>Reset
                            </a>
                            <button type="submit" class="px-8 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                                <i class="fas fa-search mr-2"></i>Cari Villa
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Info Card -->
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-600 mr-3 mt-1"></i>
                    <div>
                        <p class="text-sm text-blue-800">
                            <strong>Tips:</strong> Gunakan filter di atas untuk menyaring villa. Untuk mendapatkan ranking villa terbaik dengan metode TOPSIS, kunjungi halaman 
                            <a href="{{ route('results') }}" class="underline font-medium">Hasil Rekomendasi</a>.
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
                            Menampilkan {{ $villas->total() }} dari {{ $totalVillas ?? 0 }} villa
                        </span>
                        <select name="sort" id="sortSelect" onchange="updateSort(this.value)" class="border border-gray-300 rounded-lg px-3 py-1 text-sm">
                            <option value="recommended" {{ ($filters['sort'] ?? '') == 'recommended' ? 'selected' : '' }}>Urutkan: Rekomendasi</option>
                            <option value="price_low" {{ ($filters['sort'] ?? '') == 'price_low' ? 'selected' : '' }}>Harga: Terendah</option>
                            <option value="price_high" {{ ($filters['sort'] ?? '') == 'price_high' ? 'selected' : '' }}>Harga: Tertinggi</option>
                            <option value="rating" {{ ($filters['sort'] ?? '') == 'rating' ? 'selected' : '' }}>Rating: Tertinggi</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="villaGrid">
                    @forelse($villas as $villa)
                    <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition villa-card" data-villa-id="{{ $villa->id }}">
                        <div class="h-48 bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center relative">
                            <i class="fas fa-home text-primary-400 text-5xl"></i>
                            <button onclick="toggleFavorite({{ $villa->id }})" class="absolute top-2 right-2 bg-white p-2 rounded-full hover:bg-red-50 transition">
                                <i class="fas fa-heart text-gray-400 hover:text-red-500" id="heart-{{ $villa->id }}"></i>
                            </button>
                            <div class="absolute bottom-2 left-2">
                                <span class="bg-primary-600 text-white px-2 py-1 rounded text-xs">
                                    <i class="fas fa-users mr-1"></i>{{ $villa->capacity }} orang
                                </span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-gray-900 mb-1">{{ $villa->name }}</h4>
                            <p class="text-sm text-gray-600 mb-2">
                                <i class="fas fa-map-marker-alt text-gray-400 mr-1"></i>
                                {{ $villa->location }}
                            </p>
                            <div class="flex items-center mb-3">
                                <div class="flex text-yellow-400 mr-2">
                                    @for($i = 0; $i < floor($villa->rating); $i++)
                                    <i class="fas fa-star text-xs"></i>
                                    @endfor
                                    @if($villa->rating - floor($villa->rating) >= 0.5)
                                    <i class="fas fa-star-half-alt text-xs"></i>
                                    @endif
                                </div>
                                <span class="text-xs text-gray-500">({{ number_format($villa->rating, 1) }})</span>
                                <span class="text-xs text-gray-400 ml-2">• {{ $villa->total_reviews }} ulasan</span>
                            </div>
                            <div class="flex flex-wrap gap-1 mb-3">
                                @php
                                    $facilities = json_decode($villa->facilities ?? '[]', true) ?? [];
                                @endphp
                                @foreach(array_slice($facilities, 0, 3) as $facility)
                                <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded text-xs">{{ $facility }}</span>
                                @endforeach
                                @if(count($facilities) > 3)
                                <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded text-xs">+{{ count($facilities) - 3 }}</span>
                                @endif
                            </div>
                            <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                <div>
                                    <span class="text-lg font-bold text-primary-600">Rp {{ number_format($villa->price, 0, ',', '.') }}</span>
                                    <span class="text-xs text-gray-500">/malam</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button onclick="addToCompare({{ $villa->id }}, '{{ addslashes($villa->name) }}', '{{ addslashes($villa->location ?? '') }}', {{ $villa->price }})" 
                                        class="text-blue-600 hover:text-blue-700 text-sm" title="Bandingkan">
                                        <i class="fas fa-balance-scale"></i>
                                    </button>
                                    <a href="{{ route('villa.detail', $villa->id) }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium">
                                        Detail <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-3 text-center py-12 text-gray-400">
                        <i class="fas fa-home text-5xl mb-4"></i>
                        <p class="text-lg">Tidak ada villa ditemukan</p>
                        <p class="text-sm mt-2">Coba ubah filter Anda atau <a href="{{ route('user.villas.index') }}" class="text-primary-600 underline">reset filter</a></p>
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

    <!-- Floating Compare Button -->
    <div id="floatingCompare" class="fixed bottom-6 right-6 z-40" style="display: none;">
        <a href="{{ route('user.compare.index') }}" class="flex items-center bg-blue-600 text-white px-4 py-3 rounded-full shadow-lg hover:bg-blue-700 transition">
            <i class="fas fa-balance-scale mr-2"></i>
            <span>Bandingkan (<span id="compareCount">0</span>)</span>
        </a>
    </div>

    <script>
        // Dual Range Slider for Price
        const minPriceRange = document.getElementById('minPriceRange');
        const maxPriceRange = document.getElementById('maxPriceRange');
        const minPriceInput = document.getElementById('minPrice');
        const maxPriceInput = document.getElementById('maxPrice');
        const minPriceDisplay = document.getElementById('minPriceDisplay');
        const maxPriceDisplay = document.getElementById('maxPriceDisplay');
        const priceRangeTrack = document.getElementById('priceRangeTrack');

        function formatPrice(value) {
            return 'Rp ' + parseInt(value).toLocaleString('id-ID');
        }

        function updatePriceRangeTrack() {
            const minVal = parseInt(minPriceRange.value);
            const maxVal = parseInt(maxPriceRange.value);
            const minPercent = (minVal / 2000000) * 100;
            const maxPercent = (maxVal / 2000000) * 100;
            priceRangeTrack.style.left = minPercent + '%';
            priceRangeTrack.style.width = (maxPercent - minPercent) + '%';
        }

        // Min price range slider
        minPriceRange.addEventListener('input', function(e) {
            let minVal = parseInt(e.target.value);
            let maxVal = parseInt(maxPriceRange.value);
            
            // Prevent min from exceeding max
            if (minVal > maxVal) {
                minVal = maxVal;
                e.target.value = minVal;
            }
            
            minPriceInput.value = minVal;
            minPriceDisplay.textContent = formatPrice(minVal);
            updatePriceRangeTrack();
        });

        // Max price range slider
        maxPriceRange.addEventListener('input', function(e) {
            let maxVal = parseInt(e.target.value);
            let minVal = parseInt(minPriceRange.value);
            
            // Prevent max from going below min
            if (maxVal < minVal) {
                maxVal = minVal;
                e.target.value = maxVal;
            }
            
            maxPriceInput.value = maxVal;
            maxPriceDisplay.textContent = formatPrice(maxVal);
            updatePriceRangeTrack();
        });

        // Sync min price input with slider
        minPriceInput.addEventListener('change', function(e) {
            let value = parseInt(e.target.value) || 0;
            let maxVal = parseInt(maxPriceRange.value);
            
            if (value > maxVal) value = maxVal;
            if (value < 0) value = 0;
            if (value > 2000000) value = 2000000;
            
            minPriceRange.value = value;
            e.target.value = value;
            minPriceDisplay.textContent = formatPrice(value);
            updatePriceRangeTrack();
        });

        // Sync max price input with slider
        maxPriceInput.addEventListener('change', function(e) {
            let value = parseInt(e.target.value) || 2000000;
            let minVal = parseInt(minPriceRange.value);
            
            if (value < minVal) value = minVal;
            if (value < 0) value = 0;
            if (value > 2000000) value = 2000000;
            
            maxPriceRange.value = value;
            e.target.value = value;
            maxPriceDisplay.textContent = formatPrice(value);
            updatePriceRangeTrack();
        });

        // Initialize range track on page load
        document.addEventListener('DOMContentLoaded', function() {
            updatePriceRangeTrack();
        });

        // Update sort
        function updateSort(value) {
            const url = new URL(window.location.href);
            url.searchParams.set('sort', value);
            window.location.href = url.toString();
        }

        // Toggle favorite
        function toggleFavorite(villaId) {
            const heart = document.getElementById('heart-' + villaId);
            let favorites = JSON.parse(localStorage.getItem('villaFavorites') || '[]');
            
            if (favorites.includes(villaId)) {
                favorites = favorites.filter(id => id !== villaId);
                heart.classList.remove('text-red-500');
                heart.classList.add('text-gray-400');
            } else {
                favorites.push(villaId);
                heart.classList.remove('text-gray-400');
                heart.classList.add('text-red-500');
            }
            
            localStorage.setItem('villaFavorites', JSON.stringify(favorites));
        }

        // Add to compare
        function addToCompare(villaId, villaName, location, price) {
            let compareList = JSON.parse(localStorage.getItem('villaCompareList') || '[]');
            
            // Check if already exists
            if (compareList.some(v => v.id === villaId)) {
                alert('Villa sudah ada di daftar perbandingan');
                return;
            }
            
            if (compareList.length >= 3) {
                alert('Maksimal 3 villa yang dapat dibandingkan. Hapus salah satu villa terlebih dahulu.');
                return;
            }
            
            // Add villa with basic data (score will be fetched on compare page)
            compareList.push({
                id: villaId,
                name: villaName,
                location: location,
                price: price,
                score: 0,
                rank: 0
            });
            
            localStorage.setItem('villaCompareList', JSON.stringify(compareList));
            updateFloatingButton();
            alert('Villa berhasil ditambahkan ke perbandingan!');
        }

        function updateFloatingButton() {
            const compareList = JSON.parse(localStorage.getItem('villaCompareList') || '[]');
            const floatingBtn = document.getElementById('floatingCompare');
            const countSpan = document.getElementById('compareCount');
            
            if (compareList.length > 0) {
                floatingBtn.style.display = 'block';
                countSpan.textContent = compareList.length;
            } else {
                floatingBtn.style.display = 'none';
            }
        }

        // Load favorites on page load
        document.addEventListener('DOMContentLoaded', function() {
            const favorites = JSON.parse(localStorage.getItem('villaFavorites') || '[]');
            favorites.forEach(villaId => {
                const heart = document.getElementById('heart-' + villaId);
                if (heart) {
                    heart.classList.remove('text-gray-400');
                    heart.classList.add('text-red-500');
                }
            });
            
            // Update floating button
            updateFloatingButton();
        });
    </script>
</x-app-layout>

