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
                <a href="{{ route('results.export.pdf') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                    <i class="fas fa-download mr-2"></i>Export PDF
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            </div>
            @endif

            @if(session('info'))
            <div class="mb-6 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-lg">
                <i class="fas fa-info-circle mr-2"></i>{{ session('info') }}
            </div>
            @endif

            @if($error ?? false)
            <div class="mb-6 bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-lg">
                <i class="fas fa-exclamation-triangle mr-2"></i>{{ $error }}
            </div>
            @endif

            <!-- Filter Section -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-filter text-primary-600 mr-2"></i>
                    Filter Hasil
                </h3>
                
                <form id="topsisFilterForm" action="{{ route('results') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Harga Minimum -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-money-bill-wave text-gray-400 mr-1"></i>
                                Harga Minimum
                            </label>
                            <input type="number" name="min_price" id="minPrice" 
                                value="{{ request('min_price') }}"
                                placeholder="Rp 0"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500">
                        </div>
                        
                        <!-- Harga Maksimum -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-money-bill-wave text-gray-400 mr-1"></i>
                                Harga Maksimum
                            </label>
                            <input type="number" name="max_price" id="maxPrice" 
                                value="{{ request('max_price') }}"
                                placeholder="Rp 10.000.000"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500">
                        </div>

                        <!-- Kapasitas -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-users text-gray-400 mr-1"></i>
                                Kapasitas Minimal
                            </label>
                            <select name="capacity" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500">
                                <option value="">Semua Kapasitas</option>
                                <option value="2" {{ request('capacity') == '2' ? 'selected' : '' }}>2+ Orang</option>
                                <option value="4" {{ request('capacity') == '4' ? 'selected' : '' }}>4+ Orang</option>
                                <option value="6" {{ request('capacity') == '6' ? 'selected' : '' }}>6+ Orang</option>
                                <option value="8" {{ request('capacity') == '8' ? 'selected' : '' }}>8+ Orang</option>
                                <option value="10" {{ request('capacity') == '10' ? 'selected' : '' }}>10+ Orang</option>
                                <option value="15" {{ request('capacity') == '15' ? 'selected' : '' }}>15+ Orang</option>
                            </select>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex items-end space-x-2">
                            <button type="submit" class="flex-1 px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-medium">
                                <i class="fas fa-filter mr-1"></i>Terapkan Filter
                            </button>
                            <a href="{{ route('results') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition" title="Reset Filter">
                                <i class="fas fa-redo"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            @if($filtersApplied ?? false)
            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center flex-wrap gap-2">
                        <span class="text-sm font-medium text-green-800">
                            <i class="fas fa-check-circle mr-1"></i>Filter Diterapkan:
                        </span>
                        @if(!empty($activeFilters['min_price']))
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">
                            Min: Rp {{ number_format($activeFilters['min_price'], 0, ',', '.') }}
                        </span>
                        @endif
                        @if(!empty($activeFilters['max_price']))
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">
                            Max: Rp {{ number_format($activeFilters['max_price'], 0, ',', '.') }}
                        </span>
                        @endif
                        @if(!empty($activeFilters['capacity']))
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">
                            Min {{ $activeFilters['capacity'] }} orang
                        </span>
                        @endif
                    </div>
                    <span class="text-sm text-green-600">
                        <i class="fas fa-home mr-1"></i>{{ $villaCount ?? 0 }} villa ditemukan
                    </span>
                </div>
            </div>
            @endif

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-lg p-6 text-center border-l-4 border-primary-600">
                    <div class="bg-primary-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-home text-primary-600 text-xl"></i>
                    </div>
                    <h3 class="text-sm font-medium text-gray-500">Villa Dievaluasi</h3>
                    <p class="text-3xl font-bold text-primary-600">{{ $villaCount ?? 0 }}</p>
                    @if($filtersApplied ?? false)
                    <p class="text-xs text-gray-500">dari {{ $totalVillas ?? 0 }} total</p>
                    @endif
                </div>
                
                <div class="bg-white rounded-xl shadow-lg p-6 text-center border-l-4 border-blue-600">
                    <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-list-check text-blue-600 text-xl"></i>
                    </div>
                    <h3 class="text-sm font-medium text-gray-500">Kriteria Aktif</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $criteriaCount ?? 0 }}</p>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg p-6 text-center border-l-4 border-green-600">
                    <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-star text-green-600 text-xl"></i>
                    </div>
                    <h3 class="text-sm font-medium text-gray-500">Skor Tertinggi</h3>
                    <p class="text-3xl font-bold text-green-600">{{ number_format($topScore ?? 0, 4) }}</p>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg p-6 text-center border-l-4 border-yellow-600">
                    <div class="bg-yellow-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-chart-line text-yellow-600 text-xl"></i>
                    </div>
                    <h3 class="text-sm font-medium text-gray-500">Metode</h3>
                    <p class="text-2xl font-bold text-yellow-600">TOPSIS</p>
                    <p class="text-xs text-gray-500 mt-1">+ AHP Weights</p>
                </div>
            </div>

            <!-- Criteria Weights -->
            @if(isset($criteriaWeights) && $criteriaWeights->isNotEmpty())
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">
                    <i class="fas fa-weight text-primary-600 mr-2"></i>
                    Bobot Kriteria (dari AHP)
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    @foreach($criteriaWeights as $cw)
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <p class="text-sm text-gray-600 mb-1">{{ $cw['name'] }}</p>
                        <p class="text-xs text-gray-400 mb-2">({{ $cw['code'] }})</p>
                        <p class="text-2xl font-bold text-primary-600">
                            {{ isset($weights[$cw['code']]) ? number_format($weights[$cw['code']] * 100, 1) : '0.0' }}%
                        </p>
                    </div>
                    @endforeach
                </div>
                @if(!($weightsConfigured ?? false))
                <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                    <p class="text-sm text-yellow-700">
                        <i class="fas fa-info-circle mr-1"></i>
                        Bobot kriteria belum dikonfigurasi melalui AHP. Menggunakan bobot default (sama rata).
                    </p>
                </div>
                @endif
            </div>
            @endif

            <!-- Ranking Villa -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-900">
                        <i class="fas fa-trophy text-primary-600 mr-2"></i>
                        Ranking Villa Terbaik
                    </h3>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600">Diurutkan berdasarkan skor preferensi (Vi)</span>
                    </div>
                </div>

                <div class="space-y-4">
                    @php
                        $medals = ['🥇', '🥈', '🥉'];
                    @endphp
                    
                    @forelse($rankings ?? [] as $index => $ranking)
                    @php $villa = $ranking['villa']; @endphp
                    <div class="bg-gradient-to-r {{ $index == 0 ? 'from-yellow-50 to-yellow-100 border-l-4 border-yellow-400' : ($index == 1 ? 'from-gray-50 to-gray-100 border-l-4 border-gray-400' : ($index == 2 ? 'from-orange-50 to-orange-100 border-l-4 border-orange-400' : 'from-white to-gray-50 border-l-4 border-gray-300')) }} rounded-lg p-6 hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4 flex-1">
                                <div class="flex-shrink-0">
                                    @if($index < 3)
                                    <div class="text-4xl">{{ $medals[$index] }}</div>
                                    @else
                                    <div class="bg-gray-400 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold">
                                        {{ $ranking['rank'] }}
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
                                        {{ Str::limit($villa->address ?? $villa->location, 60) }}
                                    </p>
                                    <div class="flex items-center flex-wrap gap-2">
                                        <div class="flex text-yellow-400 mr-2">
                                            @for($i = 0; $i < floor($villa->rating ?? 0); $i++)
                                            <i class="fas fa-star text-xs"></i>
                                            @endfor
                                            @if(($villa->rating ?? 0) - floor($villa->rating ?? 0) >= 0.5)
                                            <i class="fas fa-star-half-alt text-xs"></i>
                                            @endif
                                        </div>
                                        <span class="text-xs text-gray-500 mr-4">({{ number_format($villa->rating ?? 0, 1) }})</span>
                                        <span class="text-sm text-gray-600">
                                            <i class="fas fa-users text-gray-400 mr-1"></i>
                                            {{ $villa->capacity ?? 'N/A' }} orang
                                        </span>
                                        <span class="text-sm text-gray-600 ml-2">
                                            <i class="fas fa-broom text-gray-400 mr-1"></i>
                                            Kebersihan: {{ number_format($villa->cleanliness_score ?? 0, 1) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-right ml-6">
                                <div class="text-3xl font-bold {{ $index == 0 ? 'text-yellow-600' : ($index == 1 ? 'text-gray-600' : ($index == 2 ? 'text-orange-600' : 'text-gray-600')) }}">
                                    {{ number_format($ranking['score'], 4) }}
                                </div>
                                <p class="text-sm text-gray-600 mb-1">Skor Preferensi (Vi)</p>
                                <div class="text-xs text-gray-500 mb-2">
                                    D<sup>+</sup>: {{ number_format($ranking['d_positive'], 4) }} | 
                                    D<sup>-</sup>: {{ number_format($ranking['d_negative'], 4) }}
                                </div>
                                <p class="text-lg font-semibold text-primary-600 mb-4">
                                    Rp {{ number_format($villa->price ?? 0, 0, ',', '.') }}/malam
                                </p>
                                <div class="flex space-x-2">
                                    <a href="{{ route('villa.detail', $villa->id) }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition text-sm">
                                        <i class="fas fa-eye mr-1"></i>Detail
                                    </a>
                                    <button onclick="addToCompare({{ $villa->id }})" id="compareBtn-{{ $villa->id }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm">
                                        <i class="fas fa-balance-scale mr-1"></i><span>Bandingkan</span>
                                    </button>
                                    <button onclick="toggleFavorite({{ $villa->id }})" class="bg-gray-100 text-gray-700 px-3 py-2 rounded-lg hover:bg-gray-200 transition text-sm">
                                        <i class="fas fa-heart" id="heart-{{ $villa->id }}"></i>
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
                </div>
            </div>

            <!-- TOPSIS Calculation Details (Collapsible) -->
            @if(isset($rankings) && $rankings->isNotEmpty())
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <button onclick="toggleCalculationDetails()" class="flex items-center justify-between w-full text-left">
                    <h3 class="text-xl font-semibold text-gray-900">
                        <i class="fas fa-calculator text-primary-600 mr-2"></i>
                        Detail Perhitungan TOPSIS
                    </h3>
                    <i id="toggleIcon" class="fas fa-chevron-down text-gray-500 transition-transform"></i>
                </button>
                
                <div id="calculationDetails" class="hidden mt-6 space-y-6">
                    <!-- Decision Matrix -->
                    <div>
                        <h4 class="font-semibold text-gray-800 mb-3">1. Matriks Keputusan (X)</h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm border">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="border px-3 py-2 text-left">Villa</th>
                                        @foreach($criteria ?? [] as $c)
                                        <th class="border px-3 py-2 text-center">{{ $c->code }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rankings as $ranking)
                                    <tr>
                                        <td class="border px-3 py-2 font-medium">{{ Str::limit($ranking['villa']->name, 20) }}</td>
                                        @foreach($criteria ?? [] as $c)
                                        <td class="border px-3 py-2 text-center">
                                            {{ number_format($decisionMatrix[$ranking['villa_id']][$c->code] ?? 0, 2) }}
                                        </td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Normalized Matrix -->
                    <div>
                        <h4 class="font-semibold text-gray-800 mb-3">2. Matriks Ternormalisasi (R)</h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm border">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="border px-3 py-2 text-left">Villa</th>
                                        @foreach($criteria ?? [] as $c)
                                        <th class="border px-3 py-2 text-center">{{ $c->code }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rankings as $ranking)
                                    <tr>
                                        <td class="border px-3 py-2 font-medium">{{ Str::limit($ranking['villa']->name, 20) }}</td>
                                        @foreach($criteria ?? [] as $c)
                                        <td class="border px-3 py-2 text-center">
                                            {{ number_format($normalizedMatrix[$ranking['villa_id']][$c->code] ?? 0, 4) }}
                                        </td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Weighted Normalized Matrix -->
                    <div>
                        <h4 class="font-semibold text-gray-800 mb-3">3. Matriks Ternormalisasi Terbobot (Y)</h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm border">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="border px-3 py-2 text-left">Villa</th>
                                        @foreach($criteria ?? [] as $c)
                                        <th class="border px-3 py-2 text-center">{{ $c->code }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rankings as $ranking)
                                    <tr>
                                        <td class="border px-3 py-2 font-medium">{{ Str::limit($ranking['villa']->name, 20) }}</td>
                                        @foreach($criteria ?? [] as $c)
                                        <td class="border px-3 py-2 text-center">
                                            {{ number_format($weightedMatrix[$ranking['villa_id']][$c->code] ?? 0, 4) }}
                                        </td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Ideal Solutions -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-3">4. Solusi Ideal Positif (A<sup>+</sup>)</h4>
                            <div class="bg-green-50 rounded-lg p-4">
                                <div class="grid grid-cols-3 gap-2">
                                    @foreach($criteria ?? [] as $c)
                                    <div class="text-center">
                                        <span class="text-xs text-gray-500">{{ $c->code }}</span>
                                        <p class="font-mono text-sm">{{ number_format($idealPositive[$c->code] ?? 0, 4) }}</p>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-3">5. Solusi Ideal Negatif (A<sup>-</sup>)</h4>
                            <div class="bg-red-50 rounded-lg p-4">
                                <div class="grid grid-cols-3 gap-2">
                                    @foreach($criteria ?? [] as $c)
                                    <div class="text-center">
                                        <span class="text-xs text-gray-500">{{ $c->code }}</span>
                                        <p class="font-mono text-sm">{{ number_format($idealNegative[$c->code] ?? 0, 4) }}</p>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Distances and Preference Scores -->
                    <div>
                        <h4 class="font-semibold text-gray-800 mb-3">6. Jarak dan Skor Preferensi</h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm border">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="border px-3 py-2 text-left">Rank</th>
                                        <th class="border px-3 py-2 text-left">Villa</th>
                                        <th class="border px-3 py-2 text-center">D<sup>+</sup></th>
                                        <th class="border px-3 py-2 text-center">D<sup>-</sup></th>
                                        <th class="border px-3 py-2 text-center">Vi = D<sup>-</sup>/(D<sup>+</sup>+D<sup>-</sup>)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rankings as $ranking)
                                    <tr class="{{ $ranking['rank'] <= 3 ? 'bg-yellow-50' : '' }}">
                                        <td class="border px-3 py-2 font-bold text-center">{{ $ranking['rank'] }}</td>
                                        <td class="border px-3 py-2 font-medium">{{ $ranking['villa']->name }}</td>
                                        <td class="border px-3 py-2 text-center font-mono">{{ number_format($ranking['d_positive'], 4) }}</td>
                                        <td class="border px-3 py-2 text-center font-mono">{{ number_format($ranking['d_negative'], 4) }}</td>
                                        <td class="border px-3 py-2 text-center font-mono font-bold text-primary-600">{{ number_format($ranking['score'], 4) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Formula Reference -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="font-semibold text-gray-800 mb-3">Rumus TOPSIS</h4>
                        <div class="text-sm text-gray-600 space-y-2">
                            <p><strong>Normalisasi:</strong> r<sub>ij</sub> = x<sub>ij</sub> / √(Σx<sub>ij</sub>²)</p>
                            <p><strong>Terbobot:</strong> y<sub>ij</sub> = w<sub>j</sub> × r<sub>ij</sub></p>
                            <p><strong>Solusi Ideal Positif (A<sup>+</sup>):</strong> max(y<sub>ij</sub>) untuk benefit, min(y<sub>ij</sub>) untuk cost</p>
                            <p><strong>Solusi Ideal Negatif (A<sup>-</sup>):</strong> min(y<sub>ij</sub>) untuk benefit, max(y<sub>ij</sub>) untuk cost</p>
                            <p><strong>Jarak ke Ideal Positif:</strong> D<sup>+</sup> = √Σ(y<sub>ij</sub> - y<sub>j</sub><sup>+</sup>)²</p>
                            <p><strong>Jarak ke Ideal Negatif:</strong> D<sup>-</sup> = √Σ(y<sub>ij</sub> - y<sub>j</sub><sup>-</sup>)²</p>
                            <p><strong>Skor Preferensi:</strong> V<sub>i</sub> = D<sup>-</sup> / (D<sup>+</sup> + D<sup>-</sup>)</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

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

    <!-- Floating Compare Button -->
    <div id="floatingCompare" class="fixed bottom-6 right-6 z-40" style="display: none;">
        <a href="{{ route('user.compare.index') }}" class="flex items-center bg-blue-600 text-white px-4 py-3 rounded-full shadow-lg hover:bg-blue-700 transition">
            <i class="fas fa-balance-scale mr-2"></i>
            <span>Bandingkan (<span id="compareCount">0</span>)</span>
        </a>
    </div>

    <script>
        // Villa data for comparison
        const villasData = {
            @foreach($rankings as $r)
            {{ $r['villa']->id }}: {
                id: {{ $r['villa']->id }},
                name: "{{ addslashes($r['villa']->name) }}",
                location: "{{ addslashes($r['villa']->location ?? '') }}",
                price: {{ $r['villa']->price ?? 0 }},
                score: {{ $r['score'] }},
                rank: {{ $r['rank'] }}
            },
            @endforeach
        };

        function addToCompare(villaId) {
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
            
            // Get villa data
            const villaData = villasData[villaId];
            if (villaData) {
                compareList.push(villaData);
                localStorage.setItem('villaCompareList', JSON.stringify(compareList));
                updateFloatingButton();
                alert('Villa berhasil ditambahkan ke perbandingan!');
            }
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

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', updateFloatingButton);

        function toggleCalculationDetails() {
            const details = document.getElementById('calculationDetails');
            const icon = document.getElementById('toggleIcon');
            
            if (details.classList.contains('hidden')) {
                details.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                details.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        }

        function toggleFavorite(villaId) {
            const heart = document.getElementById('heart-' + villaId);
            let favorites = JSON.parse(localStorage.getItem('villaFavorites') || '[]');
            
            if (favorites.includes(villaId)) {
                favorites = favorites.filter(id => id !== villaId);
                heart.classList.remove('text-red-500');
                heart.classList.add('text-gray-700');
            } else {
                favorites.push(villaId);
                heart.classList.remove('text-gray-700');
                heart.classList.add('text-red-500');
            }
            
            localStorage.setItem('villaFavorites', JSON.stringify(favorites));
        }

        // Load favorites on page load
        document.addEventListener('DOMContentLoaded', function() {
            const favorites = JSON.parse(localStorage.getItem('villaFavorites') || '[]');
            favorites.forEach(villaId => {
                const heart = document.getElementById('heart-' + villaId);
                if (heart) {
                    heart.classList.remove('text-gray-700');
                    heart.classList.add('text-red-500');
                }
            });
        });
    </script>
</x-app-layout>
