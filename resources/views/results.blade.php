<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                    Hasil Rekomendasi Villa
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Ranking villa terbaik berdasarkan perhitungan AHP dan TOPSIS sesuai preferensi Anda
                </p>
            </div>
            <div class="flex space-x-2">
                <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                    <i class="fas fa-download mr-2"></i>Export PDF
                </button>
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-file-excel mr-2"></i>Export Excel
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Progress Steps -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-4">
                        <div class="bg-green-600 text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold">
                            <i class="fas fa-check"></i>
                        </div>
                        <span class="text-green-600 font-semibold">Preferensi Kriteria</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="bg-green-600 text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold">
                            <i class="fas fa-check"></i>
                        </div>
                        <span class="text-green-600 font-semibold">Perbandingan AHP</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="bg-purple-600 text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold">
                            3
                        </div>
                        <span class="text-purple-600 font-semibold">Hasil Rekomendasi</span>
                    </div>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-green-600 h-2 rounded-full" style="width: 100%"></div>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                    <div class="bg-purple-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-home text-purple-600 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Villa Dievaluasi</h3>
                    <p class="text-3xl font-bold text-purple-600">52</p>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                    <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-chart-line text-blue-600 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Consistency Ratio</h3>
                    <p class="text-3xl font-bold text-green-600">0.045</p>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                    <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-star text-green-600 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Skor Tertinggi</h3>
                    <p class="text-3xl font-bold text-green-600">0.847</p>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                    <div class="bg-yellow-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Waktu Proses</h3>
                    <p class="text-3xl font-bold text-yellow-600">2.3s</p>
                </div>
            </div>

            <!-- Criteria Weights -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h3 class="text-xl font-semibold text-gray-900 mb-6">
                    <i class="fas fa-weight text-purple-600 mr-2"></i>
                    Bobot Kriteria Hasil AHP
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                    <div class="text-center p-4 bg-green-50 rounded-lg">
                        <i class="fas fa-dollar-sign text-green-600 text-2xl mb-2"></i>
                        <h4 class="font-semibold text-gray-900">Harga Sewa</h4>
                        <p class="text-2xl font-bold text-green-600">0.285</p>
                        <p class="text-sm text-gray-600">28.5%</p>
                    </div>
                    <div class="text-center p-4 bg-blue-50 rounded-lg">
                        <i class="fas fa-map-marker-alt text-blue-600 text-2xl mb-2"></i>
                        <h4 class="font-semibold text-gray-900">Lokasi</h4>
                        <p class="text-2xl font-bold text-blue-600">0.235</p>
                        <p class="text-sm text-gray-600">23.5%</p>
                    </div>
                    <div class="text-center p-4 bg-purple-50 rounded-lg">
                        <i class="fas fa-swimming-pool text-purple-600 text-2xl mb-2"></i>
                        <h4 class="font-semibold text-gray-900">Fasilitas</h4>
                        <p class="text-2xl font-bold text-purple-600">0.198</p>
                        <p class="text-sm text-gray-600">19.8%</p>
                    </div>
                    <div class="text-center p-4 bg-yellow-50 rounded-lg">
                        <i class="fas fa-sparkles text-yellow-600 text-2xl mb-2"></i>
                        <h4 class="font-semibold text-gray-900">Kebersihan</h4>
                        <p class="text-2xl font-bold text-yellow-600">0.145</p>
                        <p class="text-sm text-gray-600">14.5%</p>
                    </div>
                    <div class="text-center p-4 bg-red-50 rounded-lg">
                        <i class="fas fa-star text-red-600 text-2xl mb-2"></i>
                        <h4 class="font-semibold text-gray-900">Rating</h4>
                        <p class="text-2xl font-bold text-red-600">0.089</p>
                        <p class="text-sm text-gray-600">8.9%</p>
                    </div>
                    <div class="text-center p-4 bg-indigo-50 rounded-lg">
                        <i class="fas fa-users text-indigo-600 text-2xl mb-2"></i>
                        <h4 class="font-semibold text-gray-900">Kapasitas</h4>
                        <p class="text-2xl font-bold text-indigo-600">0.048</p>
                        <p class="text-sm text-gray-600">4.8%</p>
                    </div>
                </div>
            </div>

            <!-- Villa Rankings -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-900">
                        <i class="fas fa-trophy text-purple-600 mr-2"></i>
                        Ranking Villa Terbaik
                    </h3>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600">Diurutkan berdasarkan skor TOPSIS</span>
                        <select class="border border-gray-300 rounded-lg px-3 py-1 text-sm">
                            <option>Semua Villa</option>
                            <option>Top 10</option>
                            <option>Top 20</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-4">
                    <!-- Rank 1 -->
                    <div class="bg-gradient-to-r from-yellow-50 to-yellow-100 border-l-4 border-yellow-400 rounded-lg p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="bg-yellow-400 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold">
                                    1
                                </div>
                                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" 
                                     alt="Villa Paradise" 
                                     class="w-16 h-16 rounded-lg object-cover">
                                <div>
                                    <h4 class="text-lg font-bold text-gray-900">Villa Sleman Paradise</h4>
                                    <p class="text-gray-600">Jl. Kaliurang Km 10, Sleman</p>
                                    <div class="flex items-center mt-1">
                                        <div class="flex text-yellow-400 mr-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <span class="text-sm text-gray-600">(4.9) · 12 ulasan</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-yellow-600">0.847</div>
                                <p class="text-sm text-gray-600">Skor TOPSIS</p>
                                <p class="text-lg font-semibold text-purple-600 mt-1">Rp 850K/malam</p>
                                <div class="flex space-x-2 mt-2">
                                    <button class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition text-sm">
                                        Lihat Detail
                                    </button>
                                    <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition text-sm">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 grid grid-cols-6 gap-4">
                            <div class="text-center">
                                <div class="text-sm text-gray-600">Harga</div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-600 h-2 rounded-full" style="width: 75%"></div>
                                </div>
                                <div class="text-xs text-gray-500 mt-1">7.5/10</div>
                            </div>
                            <div class="text-center">
                                <div class="text-sm text-gray-600">Lokasi</div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: 90%"></div>
                                </div>
                                <div class="text-xs text-gray-500 mt-1">9.0/10</div>
                            </div>
                            <div class="text-center">
                                <div class="text-sm text-gray-600">Fasilitas</div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-purple-600 h-2 rounded-full" style="width: 95%"></div>
                                </div>
                                <div class="text-xs text-gray-500 mt-1">9.5/10</div>
                            </div>
                            <div class="text-center">
                                <div class="text-sm text-gray-600">Kebersihan</div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-yellow-600 h-2 rounded-full" style="width: 88%"></div>
                                </div>
                                <div class="text-xs text-gray-500 mt-1">8.8/10</div>
                            </div>
                            <div class="text-center">
                                <div class="text-sm text-gray-600">Rating</div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-red-600 h-2 rounded-full" style="width: 98%"></div>
                                </div>
                                <div class="text-xs text-gray-500 mt-1">9.8/10</div>
                            </div>
                            <div class="text-center">
                                <div class="text-sm text-gray-600">Kapasitas</div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-indigo-600 h-2 rounded-full" style="width: 80%"></div>
                                </div>
                                <div class="text-xs text-gray-500 mt-1">8 orang</div>
                            </div>
                        </div>
                    </div>

                    <!-- Rank 2 -->
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 border-l-4 border-gray-400 rounded-lg p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="bg-gray-400 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold">
                                    2
                                </div>
                                <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" 
                                     alt="Villa Kaliurang" 
                                     class="w-16 h-16 rounded-lg object-cover">
                                <div>
                                    <h4 class="text-lg font-bold text-gray-900">Villa Kaliurang Retreat</h4>
                                    <p class="text-gray-600">Jl. Boyong, Kaliurang, Sleman</p>
                                    <div class="flex items-center mt-1">
                                        <div class="flex text-yellow-400 mr-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <span class="text-sm text-gray-600">(4.8) · 15 ulasan</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-gray-600">0.756</div>
                                <p class="text-sm text-gray-600">Skor TOPSIS</p>
                                <p class="text-lg font-semibold text-purple-600 mt-1">Rp 750K/malam</p>
                                <div class="flex space-x-2 mt-2">
                                    <button class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition text-sm">
                                        Lihat Detail
                                    </button>
                                    <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition text-sm">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rank 3 -->
                    <div class="bg-gradient-to-r from-orange-50 to-orange-100 border-l-4 border-orange-400 rounded-lg p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="bg-orange-400 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold">
                                    3
                                </div>
                                <img src="https://images.unsplash.com/photo-1613490493576-7fde63acd811?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" 
                                     alt="Villa Prambanan" 
                                     class="w-16 h-16 rounded-lg object-cover">
                                <div>
                                    <h4 class="text-lg font-bold text-gray-900">Villa Prambanan View</h4>
                                    <p class="text-gray-600">Jl. Raya Prambanan, Sleman</p>
                                    <div class="flex items-center mt-1">
                                        <div class="flex text-yellow-400 mr-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <span class="text-sm text-gray-600">(4.7) · 8 ulasan</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-orange-600">0.689</div>
                                <p class="text-sm text-gray-600">Skor TOPSIS</p>
                                <p class="text-lg font-semibold text-purple-600 mt-1">Rp 650K/malam</p>
                                <div class="flex space-x-2 mt-2">
                                    <button class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition text-sm">
                                        Lihat Detail
                                    </button>
                                    <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition text-sm">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- More rankings can be added here... -->
                    <div class="text-center py-4">
                        <button class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
                            <i class="fas fa-chevron-down mr-2"></i>
                            Lihat Villa Lainnya (49 villa lagi)
                        </button>
                    </div>
                </div>
            </div>

            <!-- Calculation Details -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h3 class="text-xl font-semibold text-gray-900 mb-6">
                    <i class="fas fa-calculator text-blue-600 mr-2"></i>
                    Detail Perhitungan TOPSIS
                </h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="p-3 text-left">Villa</th>
                                <th class="p-3 text-center">D+ (Jarak ke Ideal)</th>
                                <th class="p-3 text-center">D- (Jarak ke Anti-Ideal)</th>
                                <th class="p-3 text-center">Closeness Coefficient</th>
                                <th class="p-3 text-center">Ranking</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-t">
                                <td class="p-3 font-medium">Villa Sleman Paradise</td>
                                <td class="p-3 text-center">0.1254</td>
                                <td class="p-3 text-center">0.6932</td>
                                <td class="p-3 text-center font-bold text-yellow-600">0.847</td>
                                <td class="p-3 text-center">
                                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full font-bold">1</span>
                                </td>
                            </tr>
                            <tr class="border-t">
                                <td class="p-3 font-medium">Villa Kaliurang Retreat</td>
                                <td class="p-3 text-center">0.2145</td>
                                <td class="p-3 text-center">0.5687</td>
                                <td class="p-3 text-center font-bold text-gray-600">0.756</td>
                                <td class="p-3 text-center">
                                    <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full font-bold">2</span>
                                </td>
                            </tr>
                            <tr class="border-t">
                                <td class="p-3 font-medium">Villa Prambanan View</td>
                                <td class="p-3 text-center">0.2854</td>
                                <td class="p-3 text-center">0.4321</td>
                                <td class="p-3 text-center font-bold text-orange-600">0.689</td>
                                <td class="p-3 text-center">
                                    <span class="bg-orange-100 text-orange-800 px-2 py-1 rounded-full font-bold">3</span>
                                </td>
                            </tr>
                            <tr class="border-t">
                                <td class="p-3 text-center" colspan="5">
                                    <button class="text-purple-600 hover:text-purple-700 text-sm font-medium">
                                        Lihat detail perhitungan lengkap <i class="fas fa-chevron-right ml-1"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between items-center bg-white rounded-xl shadow-lg p-6">
                <a href="/ahp-comparison" class="flex items-center px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Perbandingan AHP
                </a>
                
                <div class="flex space-x-4">
                    <button class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-redo mr-2"></i>
                        Hitung Ulang dengan Preferensi Baru
                    </button>
                    <button class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Hasil
                    </button>
                    <a href="{{ route('dashboard') }}" class="px-8 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                        <i class="fas fa-home mr-2"></i>
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add interactivity for villa details
            const detailButtons = document.querySelectorAll('button:contains("Lihat Detail")');
            
            // Simulate save to favorites
            const favoriteButtons = document.querySelectorAll('button i.fa-heart');
            favoriteButtons.forEach(btn => {
                btn.parentElement.addEventListener('click', function() {
                    if (this.classList.contains('bg-green-600')) {
                        this.classList.remove('bg-green-600');
                        this.classList.add('bg-red-600');
                        this.querySelector('i').classList.add('fas');
                        this.querySelector('i').classList.remove('far');
                    } else {
                        this.classList.add('bg-green-600');
                        this.classList.remove('bg-red-600');
                        this.querySelector('i').classList.remove('fas');
                        this.querySelector('i').classList.add('far');
                    }
                });
            });
        });
    </script>
</x-app-layout>