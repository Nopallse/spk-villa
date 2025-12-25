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
            
            <!-- Villa Header -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                <!-- Image Gallery -->
                <div class="relative">
                    <div class="h-96 bg-gray-200">
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                             alt="Villa Sleman Paradise" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="absolute top-4 left-4">
                        <span class="bg-yellow-400 text-white px-3 py-1 rounded-full text-sm font-bold">
                            <i class="fas fa-trophy mr-1"></i>Rank #1
                        </span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <span class="bg-white text-purple-600 px-3 py-1 rounded-full text-sm font-bold">
                            TOPSIS: 0.847
                        </span>
                    </div>
                    <div class="absolute bottom-4 right-4">
                        <button class="bg-black bg-opacity-50 text-white px-4 py-2 rounded-lg hover:bg-opacity-70 transition">
                            <i class="fas fa-images mr-2"></i>Lihat Semua Foto (12)
                        </button>
                    </div>
                </div>

                <!-- Villa Info -->
                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-2">
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">Villa Sleman Paradise</h1>
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400 mr-2">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="text-gray-600 mr-4">(4.9) · 12 ulasan</span>
                                <i class="fas fa-map-marker-alt text-gray-400 mr-1"></i>
                                <span class="text-gray-600">Jl. Kaliurang Km 10, Sleman, Yogyakarta</span>
                            </div>
                            
                            <div class="border-b border-gray-200 pb-6 mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">Deskripsi Villa</h3>
                                <p class="text-gray-700 leading-relaxed">
                                    Villa Sleman Paradise adalah akomodasi mewah yang terletak strategis di kawasan Kaliurang dengan 
                                    pemandangan menakjubkan Gunung Merapi. Villa ini menawarkan pengalaman menginap yang tak terlupakan 
                                    dengan fasilitas lengkap dan pelayanan terbaik. Dikelilingi oleh udara sejuk pegunungan dan suasana 
                                    alami yang menyegarkan, villa ini cocok untuk liburan keluarga, gathering perusahaan, atau retreat 
                                    pribadi. Dengan akses mudah ke berbagai destinasi wisata populer di Sleman seperti Merapi Park, 
                                    Museum Ullen Sentalu, dan Pasar Kaliurang.
                                </p>
                            </div>

                            <!-- Facilities -->
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Fasilitas Villa</h3>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-swimming-pool text-blue-600 mr-3"></i>
                                        <span class="text-gray-700">Kolam Renang</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-wifi text-blue-600 mr-3"></i>
                                        <span class="text-gray-700">WiFi Gratis</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-car text-blue-600 mr-3"></i>
                                        <span class="text-gray-700">Parkir Gratis</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-snowflake text-blue-600 mr-3"></i>
                                        <span class="text-gray-700">AC di Semua Kamar</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-utensils text-blue-600 mr-3"></i>
                                        <span class="text-gray-700">Dapur Lengkap</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-tv text-blue-600 mr-3"></i>
                                        <span class="text-gray-700">TV LED 55"</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-fire text-blue-600 mr-3"></i>
                                        <span class="text-gray-700">Area BBQ</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-couch text-blue-600 mr-3"></i>
                                        <span class="text-gray-700">Ruang Tamu Luas</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-mountain text-blue-600 mr-3"></i>
                                        <span class="text-gray-700">View Gunung Merapi</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Room Details -->
                            <div class="border-t border-gray-200 pt-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Spesifikasi Kamar</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <h4 class="font-medium text-gray-900 mb-2">Kamar Tidur</h4>
                                        <ul class="text-gray-700 space-y-1">
                                            <li>• 4 Kamar Tidur</li>
                                            <li>• 2 Kamar Master dengan King Bed</li>
                                            <li>• 2 Kamar Standard dengan Queen Bed</li>
                                            <li>• AC dan lemari pakaian di setiap kamar</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900 mb-2">Kamar Mandi</h4>
                                        <ul class="text-gray-700 space-y-1">
                                            <li>• 3 Kamar Mandi</li>
                                            <li>• 2 Dengan bathtub</li>
                                            <li>• Shower dengan air panas</li>
                                            <li>• Perlengkapan mandi disediakan</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Booking Card -->
                        <div class="lg:col-span-1">
                            <div class="bg-gray-50 rounded-xl p-6 sticky top-8">
                                <div class="text-center mb-6">
                                    <div class="text-3xl font-bold text-purple-600 mb-2">Rp 850.000</div>
                                    <div class="text-gray-600">per malam</div>
                                    <div class="text-sm text-green-600 mt-1">
                                        <i class="fas fa-check mr-1"></i>Termasuk pajak
                                    </div>
                                </div>

                                <div class="space-y-4 mb-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Check-in</label>
                                        <input type="date" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Check-out</label>
                                        <input type="date" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Tamu</label>
                                        <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500">
                                            <option>1 Tamu</option>
                                            <option>2 Tamu</option>
                                            <option>3 Tamu</option>
                                            <option>4 Tamu</option>
                                            <option>5 Tamu</option>
                                            <option>6 Tamu</option>
                                            <option>7 Tamu</option>
                                            <option>8 Tamu (Maksimal)</option>
                                        </select>
                                    </div>
                                </div>

                                <button class="w-full bg-purple-600 text-white py-3 rounded-lg font-semibold hover:bg-purple-700 transition mb-4">
                                    Pesan Sekarang
                                </button>

                                <div class="border-t border-gray-200 pt-4 space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Harga per malam</span>
                                        <span class="text-gray-900">Rp 850.000</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Biaya layanan</span>
                                        <span class="text-gray-900">Rp 50.000</span>
                                    </div>
                                    <div class="flex justify-between font-semibold text-lg">
                                        <span class="text-gray-900">Total</span>
                                        <span class="text-purple-600">Rp 900.000</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Info -->
                            <div class="bg-white rounded-xl p-6 mt-6 border">
                                <h3 class="font-semibold text-gray-900 mb-4">Informasi Cepat</h3>
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <i class="fas fa-users text-purple-600 mr-3"></i>
                                        <span class="text-gray-700">Kapasitas: 8 Orang</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-bed text-purple-600 mr-3"></i>
                                        <span class="text-gray-700">4 Kamar Tidur</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-bath text-purple-600 mr-3"></i>
                                        <span class="text-gray-700">3 Kamar Mandi</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-home text-purple-600 mr-3"></i>
                                        <span class="text-gray-700">200 m² Luas Bangunan</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-check text-purple-600 mr-3"></i>
                                        <span class="text-gray-700">Check-in: 15:00</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-times text-purple-600 mr-3"></i>
                                        <span class="text-gray-700">Check-out: 12:00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Evaluation Scores -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h3 class="text-xl font-semibold text-gray-900 mb-6">
                    <i class="fas fa-chart-bar text-purple-600 mr-2"></i>
                    Skor Evaluasi Kriteria
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="text-center p-4 bg-green-50 rounded-lg">
                        <i class="fas fa-dollar-sign text-green-600 text-3xl mb-3"></i>
                        <h4 class="font-semibold text-gray-900 mb-2">Harga Sewa</h4>
                        <div class="text-2xl font-bold text-green-600 mb-2">7.5/10</div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-green-600 h-3 rounded-full" style="width: 75%"></div>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">Bobot: 28.5%</p>
                    </div>
                    
                    <div class="text-center p-4 bg-blue-50 rounded-lg">
                        <i class="fas fa-map-marker-alt text-blue-600 text-3xl mb-3"></i>
                        <h4 class="font-semibold text-gray-900 mb-2">Lokasi</h4>
                        <div class="text-2xl font-bold text-blue-600 mb-2">9.0/10</div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-blue-600 h-3 rounded-full" style="width: 90%"></div>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">Bobot: 23.5%</p>
                    </div>
                    
                    <div class="text-center p-4 bg-purple-50 rounded-lg">
                        <i class="fas fa-swimming-pool text-purple-600 text-3xl mb-3"></i>
                        <h4 class="font-semibold text-gray-900 mb-2">Fasilitas</h4>
                        <div class="text-2xl font-bold text-purple-600 mb-2">9.5/10</div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-purple-600 h-3 rounded-full" style="width: 95%"></div>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">Bobot: 19.8%</p>
                    </div>
                    
                    <div class="text-center p-4 bg-yellow-50 rounded-lg">
                        <i class="fas fa-sparkles text-yellow-600 text-3xl mb-3"></i>
                        <h4 class="font-semibold text-gray-900 mb-2">Kebersihan</h4>
                        <div class="text-2xl font-bold text-yellow-600 mb-2">8.8/10</div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-yellow-600 h-3 rounded-full" style="width: 88%"></div>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">Bobot: 14.5%</p>
                    </div>
                    
                    <div class="text-center p-4 bg-red-50 rounded-lg">
                        <i class="fas fa-star text-red-600 text-3xl mb-3"></i>
                        <h4 class="font-semibold text-gray-900 mb-2">Rating & Ulasan</h4>
                        <div class="text-2xl font-bold text-red-600 mb-2">9.8/10</div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-red-600 h-3 rounded-full" style="width: 98%"></div>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">Bobot: 8.9%</p>
                    </div>
                    
                    <div class="text-center p-4 bg-indigo-50 rounded-lg">
                        <i class="fas fa-users text-indigo-600 text-3xl mb-3"></i>
                        <h4 class="font-semibold text-gray-900 mb-2">Kapasitas</h4>
                        <div class="text-2xl font-bold text-indigo-600 mb-2">8.0/10</div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-indigo-600 h-3 rounded-full" style="width: 80%"></div>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">Bobot: 4.8%</p>
                    </div>
                </div>
                
                <div class="mt-6 text-center bg-gradient-to-r from-purple-50 to-blue-50 rounded-lg p-4">
                    <div class="text-lg font-semibold text-gray-900 mb-2">Skor TOPSIS Akhir</div>
                    <div class="text-4xl font-bold text-purple-600">0.847</div>
                    <div class="text-sm text-gray-600 mt-1">Ranking #1 dari 52 villa</div>
                </div>
            </div>

            <!-- Location Map -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h3 class="text-xl font-semibold text-gray-900 mb-6">
                    <i class="fas fa-map text-blue-600 mr-2"></i>
                    Lokasi Villa
                </h3>
                <div class="bg-gray-200 h-64 rounded-lg flex items-center justify-center mb-4">
                    <!-- Placeholder for Google Maps -->
                    <div class="text-gray-500 text-center">
                        <i class="fas fa-map-marker-alt text-4xl mb-2"></i>
                        <p>Google Maps Integration</p>
                        <p class="text-sm">Jl. Kaliurang Km 10, Sleman, Yogyakarta</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="text-center">
                        <i class="fas fa-car text-blue-600 mb-2"></i>
                        <h4 class="font-medium text-gray-900">Bandara</h4>
                        <p class="text-gray-600">45 menit berkendara</p>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-store text-blue-600 mb-2"></i>
                        <h4 class="font-medium text-gray-900">Pusat Kota</h4>
                        <p class="text-gray-600">25 menit berkendara</p>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-mountain text-blue-600 mb-2"></i>
                        <h4 class="font-medium text-gray-900">Merapi Park</h4>
                        <p class="text-gray-600">10 menit berkendara</p>
                    </div>
                </div>
            </div>

            <!-- Reviews -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h3 class="text-xl font-semibold text-gray-900 mb-6">
                    <i class="fas fa-comments text-purple-600 mr-2"></i>
                    Ulasan Tamu (12)
                </h3>
                <div class="space-y-6">
                    <div class="border-b border-gray-200 pb-6">
                        <div class="flex items-start space-x-4">
                            <div class="bg-purple-100 w-12 h-12 rounded-full flex items-center justify-center">
                                <span class="text-purple-600 font-semibold">JD</span>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    <h4 class="font-semibold text-gray-900 mr-3">John Doe</h4>
                                    <div class="flex text-yellow-400 mr-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span class="text-sm text-gray-500">2 minggu yang lalu</span>
                                </div>
                                <p class="text-gray-700">
                                    Villa yang sangat menakjubkan! Pemandangan Gunung Merapi benar-benar spektakuler. 
                                    Fasilitas lengkap dan bersih. Staff sangat ramah dan responsif. Akan kembali lagi!
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-b border-gray-200 pb-6">
                        <div class="flex items-start space-x-4">
                            <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 font-semibold">AS</span>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    <h4 class="font-semibold text-gray-900 mr-3">Ani Sari</h4>
                                    <div class="flex text-yellow-400 mr-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span class="text-sm text-gray-500">1 bulan yang lalu</span>
                                </div>
                                <p class="text-gray-700">
                                    Perfect untuk family gathering! Kolam renang bersih dan anak-anak sangat senang. 
                                    Lokasi strategis dekat dengan tempat wisata. Highly recommended!
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button class="text-purple-600 hover:text-purple-700 font-medium">
                            Lihat semua ulasan <i class="fas fa-chevron-right ml-1"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between items-center bg-white rounded-xl shadow-lg p-6">
                <a href="/results" class="flex items-center px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Hasil Rekomendasi
                </a>
                
                <div class="flex space-x-4">
                    <button class="px-6 py-3 border border-purple-600 text-purple-600 rounded-lg hover:bg-purple-50 transition">
                        <i class="fas fa-balance-scale mr-2"></i>
                        Bandingkan Villa
                    </button>
                    <button class="px-8 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                        <i class="fas fa-calendar-check mr-2"></i>
                        Pesan Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image gallery functionality
            const galleryBtn = document.querySelector('button:contains("Lihat Semua Foto")');
            
            // Booking form interactivity
            const checkinInput = document.querySelector('input[type="date"]:first-of-type');
            const checkoutInput = document.querySelector('input[type="date"]:last-of-type');
            
            if (checkinInput && checkoutInput) {
                checkinInput.addEventListener('change', function() {
                    checkoutInput.min = this.value;
                });
            }
            
            // Heart icon toggle for favorites
            const heartBtn = document.querySelector('.fa-heart').parentElement;
            heartBtn.addEventListener('click', function() {
                const icon = this.querySelector('i');
                if (icon.classList.contains('fas')) {
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    this.classList.remove('bg-red-600');
                    this.classList.add('bg-gray-200', 'text-gray-700');
                } else {
                    icon.classList.add('fas');
                    icon.classList.remove('far');
                    this.classList.add('bg-red-600');
                    this.classList.remove('bg-gray-200', 'text-gray-700');
                }
            });
        });
    </script>
</x-app-layout>