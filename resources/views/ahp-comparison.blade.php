<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                    Perbandingan Berpasangan AHP
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Bandingkan tingkat kepentingan antar kriteria menggunakan metode Analytical Hierarchy Process
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
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
                        <div class="bg-purple-600 text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold">
                            2
                        </div>
                        <span class="text-purple-600 font-semibold">Perbandingan AHP</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="bg-gray-200 text-gray-500 w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold">
                            3
                        </div>
                        <span class="text-gray-500">Hasil Rekomendasi</span>
                    </div>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-purple-600 h-2 rounded-full" style="width: 66%"></div>
                </div>
            </div>

            <!-- AHP Theory -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-8">
                <div class="flex items-start">
                    <i class="fas fa-brain text-blue-600 text-2xl mr-3 mt-1"></i>
                    <div>
                        <h3 class="text-lg font-semibold text-blue-900 mb-2">Metode AHP - Perbandingan Berpasangan</h3>
                        <p class="text-blue-800 mb-3">
                            Pada tahap ini, Anda akan membandingkan tingkat kepentingan antara setiap pasang kriteria.
                            Gunakan skala Saaty (1-9) untuk menunjukkan seberapa penting satu kriteria dibandingkan kriteria lainnya.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-9 gap-2 text-xs">
                            <div class="text-center">
                                <div class="bg-red-100 text-red-800 p-2 rounded">1</div>
                                <p class="mt-1 text-blue-800">Sama Penting</p>
                            </div>
                            <div class="text-center">
                                <div class="bg-orange-100 text-orange-800 p-2 rounded">2</div>
                                <p class="mt-1 text-blue-800">Diantara 1-3</p>
                            </div>
                            <div class="text-center">
                                <div class="bg-yellow-100 text-yellow-800 p-2 rounded">3</div>
                                <p class="mt-1 text-blue-800">Sedikit Penting</p>
                            </div>
                            <div class="text-center">
                                <div class="bg-lime-100 text-lime-800 p-2 rounded">4</div>
                                <p class="mt-1 text-blue-800">Diantara 3-5</p>
                            </div>
                            <div class="text-center">
                                <div class="bg-green-100 text-green-800 p-2 rounded">5</div>
                                <p class="mt-1 text-blue-800">Cukup Penting</p>
                            </div>
                            <div class="text-center">
                                <div class="bg-teal-100 text-teal-800 p-2 rounded">6</div>
                                <p class="mt-1 text-blue-800">Diantara 5-7</p>
                            </div>
                            <div class="text-center">
                                <div class="bg-blue-100 text-blue-800 p-2 rounded">7</div>
                                <p class="mt-1 text-blue-800">Sangat Penting</p>
                            </div>
                            <div class="text-center">
                                <div class="bg-indigo-100 text-indigo-800 p-2 rounded">8</div>
                                <p class="mt-1 text-blue-800">Diantara 7-9</p>
                            </div>
                            <div class="text-center">
                                <div class="bg-purple-100 text-purple-800 p-2 rounded">9</div>
                                <p class="mt-1 text-blue-800">Mutlak Penting</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pairwise Comparison Form -->
            <form id="ahpForm" class="space-y-6">
                @csrf

                <!-- Comparison 1: Harga vs Lokasi -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-4">
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-dollar-sign text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Harga Sewa</h3>
                                <p class="text-sm text-gray-600">vs</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-purple-600">VS</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Lokasi Villa</h3>
                                <p class="text-sm text-gray-600">Bandingkan tingkat kepentingan</p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <i class="fas fa-map-marker-alt text-blue-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-center space-x-4">
                        <span class="text-sm font-medium text-gray-700">Harga Sewa lebih penting</span>
                        <div class="flex space-x-2">
                            <input type="radio" name="harga_vs_lokasi" value="9" id="h_l_9" class="hidden">
                            <label for="h_l_9" class="w-8 h-8 rounded-full border-2 border-purple-300 flex items-center justify-center cursor-pointer hover:bg-purple-100 transition">9</label>
                            
                            <input type="radio" name="harga_vs_lokasi" value="7" id="h_l_7" class="hidden">
                            <label for="h_l_7" class="w-8 h-8 rounded-full border-2 border-purple-300 flex items-center justify-center cursor-pointer hover:bg-purple-100 transition">7</label>
                            
                            <input type="radio" name="harga_vs_lokasi" value="5" id="h_l_5" class="hidden">
                            <label for="h_l_5" class="w-8 h-8 rounded-full border-2 border-purple-300 flex items-center justify-center cursor-pointer hover:bg-purple-100 transition">5</label>
                            
                            <input type="radio" name="harga_vs_lokasi" value="3" id="h_l_3" class="hidden">
                            <label for="h_l_3" class="w-8 h-8 rounded-full border-2 border-purple-300 flex items-center justify-center cursor-pointer hover:bg-purple-100 transition">3</label>
                            
                            <input type="radio" name="harga_vs_lokasi" value="1" id="h_l_1" class="hidden">
                            <label for="h_l_1" class="w-8 h-8 rounded-full border-2 border-gray-400 flex items-center justify-center cursor-pointer hover:bg-gray-100 transition font-semibold">1</label>
                            
                            <input type="radio" name="harga_vs_lokasi" value="0.33" id="h_l_033" class="hidden">
                            <label for="h_l_033" class="w-8 h-8 rounded-full border-2 border-blue-300 flex items-center justify-center cursor-pointer hover:bg-blue-100 transition">3</label>
                            
                            <input type="radio" name="harga_vs_lokasi" value="0.2" id="h_l_02" class="hidden">
                            <label for="h_l_02" class="w-8 h-8 rounded-full border-2 border-blue-300 flex items-center justify-center cursor-pointer hover:bg-blue-100 transition">5</label>
                            
                            <input type="radio" name="harga_vs_lokasi" value="0.14" id="h_l_014" class="hidden">
                            <label for="h_l_014" class="w-8 h-8 rounded-full border-2 border-blue-300 flex items-center justify-center cursor-pointer hover:bg-blue-100 transition">7</label>
                            
                            <input type="radio" name="harga_vs_lokasi" value="0.11" id="h_l_011" class="hidden">
                            <label for="h_l_011" class="w-8 h-8 rounded-full border-2 border-blue-300 flex items-center justify-center cursor-pointer hover:bg-blue-100 transition">9</label>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Lokasi Villa lebih penting</span>
                    </div>
                </div>

                <!-- Comparison 2: Harga vs Fasilitas -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-4">
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-dollar-sign text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Harga Sewa</h3>
                                <p class="text-sm text-gray-600">vs</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-purple-600">VS</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Fasilitas Villa</h3>
                                <p class="text-sm text-gray-600">Bandingkan tingkat kepentingan</p>
                            </div>
                            <div class="bg-purple-100 p-3 rounded-full">
                                <i class="fas fa-swimming-pool text-purple-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-center space-x-4">
                        <span class="text-sm font-medium text-gray-700">Harga Sewa lebih penting</span>
                        <div class="flex space-x-2">
                            <!-- Radio buttons untuk perbandingan -->
                            <input type="radio" name="harga_vs_fasilitas" value="9" id="h_f_9" class="hidden">
                            <label for="h_f_9" class="w-8 h-8 rounded-full border-2 border-purple-300 flex items-center justify-center cursor-pointer hover:bg-purple-100 transition">9</label>
                            
                            <input type="radio" name="harga_vs_fasilitas" value="7" id="h_f_7" class="hidden">
                            <label for="h_f_7" class="w-8 h-8 rounded-full border-2 border-purple-300 flex items-center justify-center cursor-pointer hover:bg-purple-100 transition">7</label>
                            
                            <input type="radio" name="harga_vs_fasilitas" value="5" id="h_f_5" class="hidden">
                            <label for="h_f_5" class="w-8 h-8 rounded-full border-2 border-purple-300 flex items-center justify-center cursor-pointer hover:bg-purple-100 transition">5</label>
                            
                            <input type="radio" name="harga_vs_fasilitas" value="3" id="h_f_3" class="hidden">
                            <label for="h_f_3" class="w-8 h-8 rounded-full border-2 border-purple-300 flex items-center justify-center cursor-pointer hover:bg-purple-100 transition">3</label>
                            
                            <input type="radio" name="harga_vs_fasilitas" value="1" id="h_f_1" class="hidden">
                            <label for="h_f_1" class="w-8 h-8 rounded-full border-2 border-gray-400 flex items-center justify-center cursor-pointer hover:bg-gray-100 transition font-semibold">1</label>
                            
                            <input type="radio" name="harga_vs_fasilitas" value="0.33" id="h_f_033" class="hidden">
                            <label for="h_f_033" class="w-8 h-8 rounded-full border-2 border-purple-300 flex items-center justify-center cursor-pointer hover:bg-purple-100 transition">3</label>
                            
                            <input type="radio" name="harga_vs_fasilitas" value="0.2" id="h_f_02" class="hidden">
                            <label for="h_f_02" class="w-8 h-8 rounded-full border-2 border-purple-300 flex items-center justify-center cursor-pointer hover:bg-purple-100 transition">5</label>
                            
                            <input type="radio" name="harga_vs_fasilitas" value="0.14" id="h_f_014" class="hidden">
                            <label for="h_f_014" class="w-8 h-8 rounded-full border-2 border-purple-300 flex items-center justify-center cursor-pointer hover:bg-purple-100 transition">7</label>
                            
                            <input type="radio" name="harga_vs_fasilitas" value="0.11" id="h_f_011" class="hidden">
                            <label for="h_f_011" class="w-8 h-8 rounded-full border-2 border-purple-300 flex items-center justify-center cursor-pointer hover:bg-purple-100 transition">9</label>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Fasilitas Villa lebih penting</span>
                    </div>
                </div>

                <!-- Continue with other comparisons... (showing 2 more for demo) -->
                
                <!-- Comparison: Lokasi vs Fasilitas -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-4">
                            <div class="bg-blue-100 p-3 rounded-full">
                                <i class="fas fa-map-marker-alt text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Lokasi Villa</h3>
                                <p class="text-sm text-gray-600">vs</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-purple-600">VS</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Fasilitas Villa</h3>
                                <p class="text-sm text-gray-600">Bandingkan tingkat kepentingan</p>
                            </div>
                            <div class="bg-purple-100 p-3 rounded-full">
                                <i class="fas fa-swimming-pool text-purple-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-center space-x-4">
                        <span class="text-sm font-medium text-gray-700">Lokasi Villa lebih penting</span>
                        <div class="flex space-x-2">
                            <!-- Radio buttons untuk perbandingan -->
                            <input type="radio" name="lokasi_vs_fasilitas" value="9" id="l_f_9" class="hidden">
                            <label for="l_f_9" class="w-8 h-8 rounded-full border-2 border-blue-300 flex items-center justify-center cursor-pointer hover:bg-blue-100 transition">9</label>
                            
                            <input type="radio" name="lokasi_vs_fasilitas" value="7" id="l_f_7" class="hidden">
                            <label for="l_f_7" class="w-8 h-8 rounded-full border-2 border-blue-300 flex items-center justify-center cursor-pointer hover:bg-blue-100 transition">7</label>
                            
                            <input type="radio" name="lokasi_vs_fasilitas" value="5" id="l_f_5" class="hidden">
                            <label for="l_f_5" class="w-8 h-8 rounded-full border-2 border-blue-300 flex items-center justify-center cursor-pointer hover:bg-blue-100 transition">5</label>
                            
                            <input type="radio" name="lokasi_vs_fasilitas" value="3" id="l_f_3" class="hidden">
                            <label for="l_f_3" class="w-8 h-8 rounded-full border-2 border-blue-300 flex items-center justify-center cursor-pointer hover:bg-blue-100 transition">3</label>
                            
                            <input type="radio" name="lokasi_vs_fasilitas" value="1" id="l_f_1" class="hidden">
                            <label for="l_f_1" class="w-8 h-8 rounded-full border-2 border-gray-400 flex items-center justify-center cursor-pointer hover:bg-gray-100 transition font-semibold">1</label>
                            
                            <input type="radio" name="lokasi_vs_fasilitas" value="0.33" id="l_f_033" class="hidden">
                            <label for="l_f_033" class="w-8 h-8 rounded-full border-2 border-purple-300 flex items-center justify-center cursor-pointer hover:bg-purple-100 transition">3</label>
                            
                            <input type="radio" name="lokasi_vs_fasilitas" value="0.2" id="l_f_02" class="hidden">
                            <label for="l_f_02" class="w-8 h-8 rounded-full border-2 border-purple-300 flex items-center justify-center cursor-pointer hover:bg-purple-100 transition">5</label>
                            
                            <input type="radio" name="lokasi_vs_fasilitas" value="0.14" id="l_f_014" class="hidden">
                            <label for="l_f_014" class="w-8 h-8 rounded-full border-2 border-purple-300 flex items-center justify-center cursor-pointer hover:bg-purple-100 transition">7</label>
                            
                            <input type="radio" name="lokasi_vs_fasilitas" value="0.11" id="l_f_011" class="hidden">
                            <label for="l_f_011" class="w-8 h-8 rounded-full border-2 border-purple-300 flex items-center justify-center cursor-pointer hover:bg-purple-100 transition">9</label>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Fasilitas Villa lebih penting</span>
                    </div>
                </div>

                <!-- Progress Card -->
                <div class="bg-gradient-to-r from-purple-600 to-blue-600 rounded-xl p-6 text-white">
                    <h3 class="text-xl font-semibold mb-4">Progress Perbandingan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="text-center">
                            <p class="text-purple-100">Total Perbandingan</p>
                            <p class="text-2xl font-bold">15</p>
                            <p class="text-sm text-purple-100">untuk 6 kriteria</p>
                        </div>
                        <div class="text-center">
                            <p class="text-purple-100">Selesai</p>
                            <p class="text-2xl font-bold" id="completedComparisons">0</p>
                            <p class="text-sm text-purple-100">perbandingan</p>
                        </div>
                        <div class="text-center">
                            <p class="text-purple-100">Consistency Ratio</p>
                            <p class="text-2xl font-bold" id="consistencyRatio">-</p>
                            <p class="text-sm text-purple-100">harus ≤ 0.1</p>
                        </div>
                    </div>
                </div>

                <!-- Matrix Preview -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">
                        <i class="fas fa-table text-purple-600 mr-2"></i>
                        Preview Matriks Perbandingan
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-center" id="comparisonMatrix">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="p-3 text-sm font-semibold text-gray-700">Kriteria</th>
                                    <th class="p-3 text-sm font-semibold text-gray-700">Harga</th>
                                    <th class="p-3 text-sm font-semibold text-gray-700">Lokasi</th>
                                    <th class="p-3 text-sm font-semibold text-gray-700">Fasilitas</th>
                                    <th class="p-3 text-sm font-semibold text-gray-700">Kebersihan</th>
                                    <th class="p-3 text-sm font-semibold text-gray-700">Rating</th>
                                    <th class="p-3 text-sm font-semibold text-gray-700">Kapasitas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-t">
                                    <td class="p-3 font-medium text-gray-700 bg-gray-50">Harga</td>
                                    <td class="p-3 bg-purple-50 font-semibold">1.00</td>
                                    <td class="p-3" id="h_l_cell">-</td>
                                    <td class="p-3" id="h_f_cell">-</td>
                                    <td class="p-3">-</td>
                                    <td class="p-3">-</td>
                                    <td class="p-3">-</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="p-3 font-medium text-gray-700 bg-gray-50">Lokasi</td>
                                    <td class="p-3" id="l_h_cell">-</td>
                                    <td class="p-3 bg-purple-50 font-semibold">1.00</td>
                                    <td class="p-3" id="l_f_cell">-</td>
                                    <td class="p-3">-</td>
                                    <td class="p-3">-</td>
                                    <td class="p-3">-</td>
                                </tr>
                                <!-- Add more rows for other criteria -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between items-center bg-white rounded-xl shadow-lg p-6">
                    <a href="/preferences" class="flex items-center px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Preferensi
                    </a>
                    
                    <div class="flex space-x-4">
                        <button type="button" id="resetMatrix" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                            <i class="fas fa-refresh mr-2"></i>
                            Reset Matriks
                        </button>
                        <button type="button" id="calculateAHP" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            <i class="fas fa-calculator mr-2"></i>
                            Hitung AHP
                        </button>
                        <button type="submit" class="px-8 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition disabled:opacity-50 disabled:cursor-not-allowed" id="submitBtn" disabled>
                            <i class="fas fa-arrow-right mr-2"></i>
                            Lihat Hasil Rekomendasi
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('ahpForm');
            const radioInputs = form.querySelectorAll('input[type="radio"]');
            const submitBtn = document.getElementById('submitBtn');
            const calculateBtn = document.getElementById('calculateAHP');
            const resetBtn = document.getElementById('resetMatrix');
            const completedSpan = document.getElementById('completedComparisons');
            const crSpan = document.getElementById('consistencyRatio');

            // Update matrix display when radio changes
            function updateMatrixDisplay() {
                let completed = 0;
                
                // Update matrix cells based on selections
                const hargaLokasi = document.querySelector('input[name="harga_vs_lokasi"]:checked');
                if (hargaLokasi) {
                    document.getElementById('h_l_cell').textContent = parseFloat(hargaLokasi.value).toFixed(2);
                    document.getElementById('l_h_cell').textContent = (1/parseFloat(hargaLokasi.value)).toFixed(2);
                    completed++;
                }

                const hargaFasilitas = document.querySelector('input[name="harga_vs_fasilitas"]:checked');
                if (hargaFasilitas) {
                    document.getElementById('h_f_cell').textContent = parseFloat(hargaFasilitas.value).toFixed(2);
                    completed++;
                }

                const lokasiFasilitas = document.querySelector('input[name="lokasi_vs_fasilitas"]:checked');
                if (lokasiFasilitas) {
                    document.getElementById('l_f_cell').textContent = parseFloat(lokasiFasilitas.value).toFixed(2);
                    completed++;
                }

                completedSpan.textContent = completed;

                // Enable calculate button if enough comparisons are made
                if (completed >= 3) { // minimum for demo
                    calculateBtn.disabled = false;
                } else {
                    calculateBtn.disabled = true;
                }
            }

            // Add change listeners to all radio inputs
            radioInputs.forEach(radio => {
                radio.addEventListener('change', function() {
                    // Update visual state of selected radio
                    const name = this.name;
                    document.querySelectorAll(`input[name="${name}"]`).forEach(r => {
                        const label = document.querySelector(`label[for="${r.id}"]`);
                        if (r.checked) {
                            label.classList.add('bg-purple-600', 'text-white');
                            label.classList.remove('border-purple-300', 'border-blue-300', 'border-gray-400');
                        } else {
                            label.classList.remove('bg-purple-600', 'text-white');
                            if (r.value === '1') {
                                label.classList.add('border-gray-400');
                            } else if (parseFloat(r.value) > 1) {
                                label.classList.add('border-purple-300');
                            } else {
                                label.classList.add('border-blue-300');
                            }
                        }
                    });
                    
                    updateMatrixDisplay();
                });
            });

            calculateBtn.addEventListener('click', function() {
                this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menghitung...';
                this.disabled = true;

                // Simulate AHP calculation
                setTimeout(() => {
                    const cr = (Math.random() * 0.08 + 0.02).toFixed(3); // Random CR between 0.02-0.1
                    crSpan.textContent = cr;
                    
                    if (parseFloat(cr) <= 0.1) {
                        crSpan.className = 'text-2xl font-bold text-green-400';
                        submitBtn.disabled = false;
                    } else {
                        crSpan.className = 'text-2xl font-bold text-red-400';
                        alert('Consistency Ratio melebihi 0.1. Silakan periksa kembali perbandingan Anda.');
                    }
                    
                    this.innerHTML = '<i class="fas fa-calculator mr-2"></i>Hitung Ulang AHP';
                    this.disabled = false;
                }, 2000);
            });

            resetBtn.addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin mereset semua perbandingan?')) {
                    radioInputs.forEach(radio => {
                        radio.checked = false;
                        const label = document.querySelector(`label[for="${radio.id}"]`);
                        label.classList.remove('bg-purple-600', 'text-white');
                    });
                    updateMatrixDisplay();
                    crSpan.textContent = '-';
                    submitBtn.disabled = true;
                }
            });

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
                submitBtn.disabled = true;

                setTimeout(() => {
                    alert('Perhitungan AHP selesai! Anda akan dialihkan ke halaman hasil rekomendasi.');
                    // In real implementation, redirect to results page
                    // window.location.href = '/results';
                }, 2000);
            });

            // Initial update
            updateMatrixDisplay();
        });
    </script>
</x-app-layout>