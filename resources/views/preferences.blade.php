<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                    Input Preferensi Kriteria
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Tentukan tingkat kepentingan setiap kriteria untuk mendapatkan rekomendasi villa yang sesuai
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Progress Steps -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-4">
                        <div class="bg-primary-600 text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold">
                            1
                        </div>
                        <span class="text-primary-600 font-semibold">Preferensi Kriteria</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="bg-gray-200 text-gray-500 w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold">
                            2
                        </div>
                        <span class="text-gray-500">Perbandingan AHP</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="bg-gray-200 text-gray-500 w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold">
                            3
                        </div>
                        <span class="text-gray-500">Hasil Rekomendasi</span>
                    </div>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-primary-600 h-2 rounded-full" style="width: 33%"></div>
                </div>
            </div>

            <!-- Information Card -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-8">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-600 text-xl mr-3 mt-1"></i>
                    <div>
                        <h3 class="text-lg font-semibold text-blue-900 mb-2">Panduan Penggunaan</h3>
                        <p class="text-blue-800 mb-3">
                            Berikan penilaian tingkat kepentingan untuk setiap kriteria villa menggunakan skala 1-5.
                            Semakin tinggi nilai yang Anda berikan, semakin penting kriteria tersebut dalam pemilihan villa.
                        </p>
                        <div class="grid grid-cols-5 gap-2 text-sm">
                            <div class="text-center">
                                <div class="bg-red-100 text-red-800 p-2 rounded">1</div>
                                <p class="mt-1 text-blue-800">Tidak Penting</p>
                            </div>
                            <div class="text-center">
                                <div class="bg-yellow-100 text-yellow-800 p-2 rounded">2</div>
                                <p class="mt-1 text-blue-800">Kurang Penting</p>
                            </div>
                            <div class="text-center">
                                <div class="bg-blue-100 text-blue-800 p-2 rounded">3</div>
                                <p class="mt-1 text-blue-800">Cukup Penting</p>
                            </div>
                            <div class="text-center">
                                <div class="bg-green-100 text-green-800 p-2 rounded">4</div>
                                <p class="mt-1 text-blue-800">Penting</p>
                            </div>
                            <div class="text-center">
                                <div class="bg-purple-100 text-purple-800 p-2 rounded">5</div>
                                <p class="mt-1 text-blue-800">Sangat Penting</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Criteria Form -->
            <form id="criteriaForm" class="space-y-6">
                @csrf

                <!-- Harga Sewa -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center mb-3">
                                <div class="bg-green-100 p-3 rounded-full mr-4">
                                    <i class="fas fa-dollar-sign text-green-600 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900">Harga Sewa Villa</h3>
                                    <p class="text-gray-600 text-sm">Pertimbangan biaya sewa per malam (Cost - semakin murah semakin baik)</p>
                                </div>
                            </div>
                            <p class="text-gray-700 mb-4">
                                Seberapa penting harga sewa villa dalam menentukan pilihan Anda? 
                                Villa dengan harga lebih murah akan mendapat skor lebih tinggi.
                            </p>
                        </div>
                        <div class="ml-6">
                            <label class="text-sm text-gray-600 mb-3 block">Tingkat Kepentingan:</label>
                            <div class="grid grid-cols-5 gap-2">
                                <div class="importance-card" data-value="1" data-name="harga_sewa">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">1</div>
                                        <div class="text-xs text-gray-500">Tidak Penting</div>
                                    </div>
                                </div>
                                <div class="importance-card" data-value="2" data-name="harga_sewa">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">2</div>
                                        <div class="text-xs text-gray-500">Kurang Penting</div>
                                    </div>
                                </div>
                                <div class="importance-card" data-value="3" data-name="harga_sewa">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">3</div>
                                        <div class="text-xs text-gray-500">Cukup Penting</div>
                                    </div>
                                </div>
                                <div class="importance-card" data-value="4" data-name="harga_sewa">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">4</div>
                                        <div class="text-xs text-gray-500">Penting</div>
                                    </div>
                                </div>
                                <div class="importance-card" data-value="5" data-name="harga_sewa">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">5</div>
                                        <div class="text-xs text-gray-500">Sangat Penting</div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="harga_sewa" id="harga_sewa_input" value="">
                        </div>
                    </div>
                </div>

                <!-- Lokasi -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center mb-3">
                                <div class="bg-blue-100 p-3 rounded-full mr-4">
                                    <i class="fas fa-map-marker-alt text-blue-600 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900">Lokasi Villa</h3>
                                    <p class="text-gray-600 text-sm">Kemudahan akses dan kedekatan dengan objek wisata (Benefit - semakin strategis semakin baik)</p>
                                </div>
                            </div>
                            <p class="text-gray-700 mb-4">
                                Seberapa penting lokasi villa yang strategis dan mudah diakses? 
                                Termasuk kedekatan dengan tempat wisata, restoran, dan fasilitas umum.
                            </p>
                        </div>
                        <div class="ml-6">
                            <label class="text-sm text-gray-600 mb-3 block">Tingkat Kepentingan:</label>
                            <div class="grid grid-cols-5 gap-2">
                                <div class="importance-card" data-value="1" data-name="lokasi">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">1</div>
                                        <div class="text-xs text-gray-500">Tidak Penting</div>
                                    </div>
                                </div>
                                <div class="importance-card" data-value="2" data-name="lokasi">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">2</div>
                                        <div class="text-xs text-gray-500">Kurang Penting</div>
                                    </div>
                                </div>
                                <div class="importance-card" data-value="3" data-name="lokasi">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">3</div>
                                        <div class="text-xs text-gray-500">Cukup Penting</div>
                                    </div>
                                </div>
                                <div class="importance-card" data-value="4" data-name="lokasi">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">4</div>
                                        <div class="text-xs text-gray-500">Penting</div>
                                    </div>
                                </div>
                                <div class="importance-card" data-value="5" data-name="lokasi">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">5</div>
                                        <div class="text-xs text-gray-500">Sangat Penting</div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="lokasi" id="lokasi_input" value="">
                        </div>
                    </div>
                </div>

                <!-- Fasilitas -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center mb-3">
                                <div class="bg-purple-100 p-3 rounded-full mr-4">
                                    <i class="fas fa-swimming-pool text-purple-600 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900">Fasilitas Villa</h3>
                                    <p class="text-gray-600 text-sm">Kelengkapan fasilitas seperti kolam renang, WiFi, AC, dll (Benefit - semakin lengkap semakin baik)</p>
                                </div>
                            </div>
                            <p class="text-gray-700 mb-4">
                                Seberapa penting kelengkapan fasilitas villa untuk kenyamanan Anda? 
                                Termasuk kolam renang, WiFi, AC, dapur, area BBQ, dan fasilitas lainnya.
                            </p>
                        </div>
                        <div class="ml-6">
                            <label class="text-sm text-gray-600 mb-3 block">Tingkat Kepentingan:</label>
                            <div class="grid grid-cols-5 gap-2">
                                <div class="importance-card" data-value="1" data-name="fasilitas">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">1</div>
                                        <div class="text-xs text-gray-500">Tidak Penting</div>
                                    </div>
                                </div>
                                <div class="importance-card" data-value="2" data-name="fasilitas">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">2</div>
                                        <div class="text-xs text-gray-500">Kurang Penting</div>
                                    </div>
                                </div>
                                <div class="importance-card" data-value="3" data-name="fasilitas">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">3</div>
                                        <div class="text-xs text-gray-500">Cukup Penting</div>
                                    </div>
                                </div>
                                <div class="importance-card" data-value="4" data-name="fasilitas">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">4</div>
                                        <div class="text-xs text-gray-500">Penting</div>
                                    </div>
                                </div>
                                <div class="importance-card" data-value="5" data-name="fasilitas">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">5</div>
                                        <div class="text-xs text-gray-500">Sangat Penting</div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="fasilitas" id="fasilitas_input" value="">
                        </div>
                    </div>
                </div>

                <!-- Kebersihan -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center mb-3">
                                <div class="bg-yellow-100 p-3 rounded-full mr-4">
                                    <i class="fas fa-sparkles text-yellow-600 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900">Kebersihan Villa</h3>
                                    <p class="text-gray-600 text-sm">Tingkat kebersihan dan maintenance villa (Benefit - semakin bersih semakin baik)</p>
                                </div>
                            </div>
                            <p class="text-gray-700 mb-4">
                                Seberapa penting kebersihan villa dan maintenance yang baik untuk kenyamanan menginap Anda? 
                                Termasuk kebersihan kamar, kamar mandi, dan area umum.
                            </p>
                        </div>
                        <div class="ml-6">
                            <label class="text-sm text-gray-600 mb-3 block">Tingkat Kepentingan:</label>
                            <div class="grid grid-cols-5 gap-2">
                                <div class="importance-card" data-value="1" data-name="kebersihan">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">1</div>
                                        <div class="text-xs text-gray-500">Tidak Penting</div>
                                    </div>
                                </div>
                                <div class="importance-card" data-value="2" data-name="kebersihan">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">2</div>
                                        <div class="text-xs text-gray-500">Kurang Penting</div>
                                    </div>
                                </div>
                                <div class="importance-card" data-value="3" data-name="kebersihan">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">3</div>
                                        <div class="text-xs text-gray-500">Cukup Penting</div>
                                    </div>
                                </div>
                                <div class="importance-card" data-value="4" data-name="kebersihan">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">4</div>
                                        <div class="text-xs text-gray-500">Penting</div>
                                    </div>
                                </div>
                                <div class="importance-card" data-value="5" data-name="kebersihan">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">5</div>
                                        <div class="text-xs text-gray-500">Sangat Penting</div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="kebersihan" id="kebersihan_input" value="">
                        </div>
                    </div>
                </div>

                <!-- Rating & Ulasan -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center mb-3">
                                <div class="bg-red-100 p-3 rounded-full mr-4">
                                    <i class="fas fa-star text-red-600 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900">Rating & Ulasan</h3>
                                    <p class="text-gray-600 text-sm">Penilaian dan review dari tamu sebelumnya (Benefit - semakin tinggi rating semakin baik)</p>
                                </div>
                            </div>
                            <p class="text-gray-700 mb-4">
                                Seberapa penting rating dan ulasan dari pengunjung sebelumnya dalam mempengaruhi keputusan Anda? 
                                Review dapat memberikan gambaran pengalaman nyata menginap di villa.
                            </p>
                        </div>
                        <div class="ml-6">
                            <label class="text-sm text-gray-600 mb-3 block">Tingkat Kepentingan:</label>
                            <div class="grid grid-cols-5 gap-2">
                                <div class="importance-card" data-value="1" data-name="rating_ulasan">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">1</div>
                                        <div class="text-xs text-gray-500">Tidak Penting</div>
                                    </div>
                                </div>
                                <div class="importance-card" data-value="2" data-name="rating_ulasan">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">2</div>
                                        <div class="text-xs text-gray-500">Kurang Penting</div>
                                    </div>
                                </div>
                                <div class="importance-card" data-value="3" data-name="rating_ulasan">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">3</div>
                                        <div class="text-xs text-gray-500">Cukup Penting</div>
                                    </div>
                                </div>
                                <div class="importance-card" data-value="4" data-name="rating_ulasan">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">4</div>
                                        <div class="text-xs text-gray-500">Penting</div>
                                    </div>
                                </div>
                                <div class="importance-card" data-value="5" data-name="rating_ulasan">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">5</div>
                                        <div class="text-xs text-gray-500">Sangat Penting</div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="rating_ulasan" id="rating_ulasan_input" value="">
                        </div>
                    </div>
                </div>

                <!-- Kapasitas -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center mb-3">
                                <div class="bg-indigo-100 p-3 rounded-full mr-4">
                                    <i class="fas fa-users text-indigo-600 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900">Kapasitas Villa</h3>
                                    <p class="text-gray-600 text-sm">Jumlah maksimum tamu yang dapat ditampung (Benefit - semakin sesuai kebutuhan semakin baik)</p>
                                </div>
                            </div>
                            <p class="text-gray-700 mb-4">
                                Seberapa penting kapasitas villa sesuai dengan jumlah tamu yang akan menginap? 
                                Villa yang dapat menampung sesuai kebutuhan grup Anda.
                            </p>
                        </div>
                        <div class="ml-6">
                            <label class="text-sm text-gray-600 mb-3 block">Tingkat Kepentingan:</label>
                            <div class="grid grid-cols-5 gap-2">
                                <div class="importance-card" data-value="1" data-name="kapasitas">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">1</div>
                                        <div class="text-xs text-gray-500">Tidak Penting</div>
                                    </div>
                                </div>
                                <div class="importance-card" data-value="2" data-name="kapasitas">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">2</div>
                                        <div class="text-xs text-gray-500">Kurang Penting</div>
                                    </div>
                                </div>
                                <div class="importance-card" data-value="3" data-name="kapasitas">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">3</div>
                                        <div class="text-xs text-gray-500">Cukup Penting</div>
                                    </div>
                                </div>
                                <div class="importance-card" data-value="4" data-name="kapasitas">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">4</div>
                                        <div class="text-xs text-gray-500">Penting</div>
                                    </div>
                                </div>
                                <div class="importance-card" data-value="5" data-name="kapasitas">
                                    <div class="border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer hover:border-primary-300 hover:bg-primary-50 transition-all duration-200">
                                        <div class="text-lg font-bold text-gray-700">5</div>
                                        <div class="text-xs text-gray-500">Sangat Penting</div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="kapasitas" id="kapasitas_input" value="">
                        </div>
                    </div>
                </div>

                <!-- Summary Card -->
                <div class="bg-gradient-to-r from-purple-600 to-blue-600 rounded-xl p-6 text-white">
                    <h3 class="text-xl font-semibold mb-4">Ringkasan Preferensi</h3>
                    <div id="preferenceSummary" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="text-center">
                            <p class="text-purple-100">Total Kriteria</p>
                            <p class="text-2xl font-bold">6</p>
                        </div>
                        <div class="text-center">
                            <p class="text-purple-100">Terisi</p>
                            <p class="text-2xl font-bold" id="filledCriteria">0</p>
                        </div>
                        <div class="text-center">
                            <p class="text-purple-100">Progress</p>
                            <p class="text-2xl font-bold" id="progressPercentage">0%</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between items-center bg-white rounded-xl shadow-lg p-6">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Dashboard
                    </a>
                    
                    <div class="flex space-x-4">
                        <button type="button" id="resetForm" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                            <i class="fas fa-refresh mr-2"></i>
                            Reset
                        </button>
                        <button type="submit" class="px-8 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition disabled:opacity-50 disabled:cursor-not-allowed" id="submitBtn" disabled>
                            <i class="fas fa-arrow-right mr-2"></i>
                            Lanjut ke Perbandingan AHP
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('criteriaForm');
            const selects = form.querySelectorAll('select');
            const submitBtn = document.getElementById('submitBtn');
            const resetBtn = document.getElementById('resetForm');
            const filledCriteriaSpan = document.getElementById('filledCriteria');
            const progressPercentageSpan = document.getElementById('progressPercentage');

            function updateProgress() {
                let filledCount = 0;
                selects.forEach(select => {
                    if (select.value !== '') {
                        filledCount++;
                    }
                });

                filledCriteriaSpan.textContent = filledCount;
                const percentage = Math.round((filledCount / selects.length) * 100);
                progressPercentageSpan.textContent = percentage + '%';

                // Enable submit button if all fields are filled
                if (filledCount === selects.length) {
                    submitBtn.disabled = false;
                } else {
                    submitBtn.disabled = true;
                }
            }

            selects.forEach(select => {
                select.addEventListener('change', updateProgress);
            });

            resetBtn.addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin mereset semua preferensi?')) {
                    selects.forEach(select => {
                        select.value = '';
                    });
                    updateProgress();
                }
            });

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Show loading state
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
                submitBtn.disabled = true;

                // Simulate form submission
                setTimeout(() => {
                    alert('Preferensi berhasil disimpan! Anda akan dialihkan ke halaman Perbandingan AHP.');
                    // In real implementation, redirect to AHP comparison page
                    // window.location.href = '/ahp-comparison';
                }, 2000);
            });

            // Handle importance card selection
            const importanceCards = document.querySelectorAll('.importance-card');
            
            importanceCards.forEach(card => {
                card.addEventListener('click', function() {
                    const value = this.getAttribute('data-value');
                    const name = this.getAttribute('data-name');
                    
                    // Remove active state from all cards with same name
                    document.querySelectorAll(`[data-name="${name}"]`).forEach(c => {
                        c.querySelector('div').classList.remove('border-primary-500', 'bg-primary-100', 'shadow-md');
                        c.querySelector('div').classList.add('border-gray-200');
                        c.querySelector('.text-lg').classList.remove('text-primary-700');
                        c.querySelector('.text-lg').classList.add('text-gray-700');
                    });
                    
                    // Add active state to clicked card
                    const cardDiv = this.querySelector('div');
                    cardDiv.classList.remove('border-gray-200');
                    cardDiv.classList.add('border-primary-500', 'bg-primary-100', 'shadow-md');
                    this.querySelector('.text-lg').classList.remove('text-gray-700');
                    this.querySelector('.text-lg').classList.add('text-primary-700');
                    
                    // Update hidden input
                    const hiddenInput = document.getElementById(`${name}_input`);
                    if (hiddenInput) {
                        hiddenInput.value = value;
                    }
                    
                    // Add animation effect
                    cardDiv.style.transform = 'scale(1.05)';
                    setTimeout(() => {
                        cardDiv.style.transform = 'scale(1)';
                    }, 150);
                });
                
                // Add hover effects
                card.addEventListener('mouseenter', function() {
                    if (!this.querySelector('div').classList.contains('border-primary-500')) {
                        this.querySelector('div').style.transform = 'translateY(-2px)';
                        this.querySelector('div').style.boxShadow = '0 4px 12px rgba(0,0,0,0.1)';
                    }
                });
                
                card.addEventListener('mouseleave', function() {
                    if (!this.querySelector('div').classList.contains('border-primary-500')) {
                        this.querySelector('div').style.transform = 'translateY(0)';
                        this.querySelector('div').style.boxShadow = 'none';
                    }
                });
            });
        });
    </script>
</x-app-layout>