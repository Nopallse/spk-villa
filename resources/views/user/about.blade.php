<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                    Tentang Sistem SPK
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Penjelasan tentang metode AHP dan TOPSIS yang digunakan dalam sistem
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Introduction -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-info-circle text-primary-600 mr-2"></i>
                    Sistem Pendukung Keputusan (SPK)
                </h3>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Sistem ini menggunakan kombinasi metode <strong>Analytical Hierarchy Process (AHP)</strong> dan 
                    <strong>Technique for Order Preference by Similarity to Ideal Solution (TOPSIS)</strong> untuk 
                    memberikan rekomendasi villa terbaik sesuai dengan kebutuhan Anda.
                </p>
                <p class="text-gray-700 leading-relaxed">
                    Bobot kriteria ditentukan oleh ahli melalui perhitungan AHP, kemudian digunakan dalam metode TOPSIS 
                    untuk melakukan perangkingan villa.
                </p>
            </div>

            <!-- AHP Explanation -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <div class="flex items-center mb-6">
                    <div class="bg-primary-100 p-3 rounded-full mr-4">
                        <i class="fas fa-balance-scale text-primary-600 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900">Metode AHP</h3>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">Apa itu AHP?</h4>
                        <p class="text-gray-700">
                            Analytical Hierarchy Process (AHP) adalah metode pengambilan keputusan yang digunakan untuk 
                            menentukan bobot prioritas dari berbagai kriteria melalui perbandingan berpasangan.
                        </p>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">Bagaimana AHP Bekerja?</h4>
                        <ol class="list-decimal list-inside space-y-2 text-gray-700">
                            <li><strong>Perbandingan Berpasangan:</strong> Setiap kriteria dibandingkan dengan kriteria lainnya menggunakan skala Saaty (1-9)</li>
                            <li><strong>Matriks Perbandingan:</strong> Hasil perbandingan disusun dalam bentuk matriks</li>
                            <li><strong>Normalisasi:</strong> Matriks dinormalisasi untuk mendapatkan eigenvector</li>
                            <li><strong>Bobot Prioritas:</strong> Eigenvector yang dihasilkan menjadi bobot prioritas setiap kriteria</li>
                            <li><strong>Uji Konsistensi:</strong> Dilakukan uji konsistensi untuk memastikan perbandingan logis (CR ≤ 0.1)</li>
                        </ol>
                    </div>
                    
                    <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded">
                        <p class="text-sm text-blue-800">
                            <strong>Catatan:</strong> Dalam sistem ini, bobot kriteria sudah ditentukan oleh administrator 
                            melalui perhitungan AHP. Anda tidak perlu melakukan perbandingan ulang.
                        </p>
                    </div>
                </div>
            </div>

            <!-- TOPSIS Explanation -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <div class="flex items-center mb-6">
                    <div class="bg-green-100 p-3 rounded-full mr-4">
                        <i class="fas fa-chart-line text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900">Metode TOPSIS</h3>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">Apa itu TOPSIS?</h4>
                        <p class="text-gray-700">
                            Technique for Order Preference by Similarity to Ideal Solution (TOPSIS) adalah metode 
                            pengambilan keputusan multi-kriteria yang memilih alternatif terbaik berdasarkan kedekatan 
                            dengan solusi ideal positif dan jarak dari solusi ideal negatif.
                        </p>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">Bagaimana TOPSIS Bekerja?</h4>
                        <ol class="list-decimal list-inside space-y-2 text-gray-700">
                            <li><strong>Normalisasi Matriks:</strong> Data villa dinormalisasi untuk setiap kriteria</li>
                            <li><strong>Matriks Terbobot:</strong> Matriks dinormalisasi dikalikan dengan bobot dari AHP</li>
                            <li><strong>Solusi Ideal Positif:</strong> Menentukan nilai terbaik untuk setiap kriteria</li>
                            <li><strong>Solusi Ideal Negatif:</strong> Menentukan nilai terburuk untuk setiap kriteria</li>
                            <li><strong>Jarak ke Ideal:</strong> Menghitung jarak setiap villa ke solusi ideal positif dan negatif</li>
                            <li><strong>Skor Preferensi:</strong> Menghitung skor preferensi (Vi) berdasarkan jarak relatif</li>
                            <li><strong>Ranking:</strong> Villa diurutkan berdasarkan skor preferensi tertinggi</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Criteria List -->
            @php
                $criteria = \App\Models\Criteria::active()->ordered()->get();
            @endphp
            @if(count($criteria) > 0)
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-list text-primary-600 mr-2"></i>
                    Daftar Kriteria
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($criteria as $index => $criterion)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <div class="bg-primary-100 p-2 rounded-full mr-3">
                                <i class="fas fa-{{ ['dollar-sign', 'map-marker-alt', 'swimming-pool', 'sparkles', 'star', 'users'][$index % 6] }} text-primary-600"></i>
                            </div>
                            <h4 class="font-semibold text-gray-900">{{ $criterion->name }}</h4>
                        </div>
                        <p class="text-sm text-gray-600 mb-2">{{ $criterion->description ?? 'Kriteria penilaian villa' }}</p>
                        @if($criterion->weight)
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500">Bobot:</span>
                            <span class="font-bold text-primary-600">{{ number_format($criterion->weight * 100, 2) }}%</span>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Criteria Weights -->
            @if(count($criteria) > 0)
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-weight text-primary-600 mr-2"></i>
                    Bobot Kriteria (Read-Only)
                </h3>
                <div class="space-y-4">
                    @foreach($criteria as $criterion)
                    @if($criterion->weight)
                    @php
                        $maxWeight = $criteria->max('weight') ?? 1;
                        $widthPercent = ($criterion->weight / $maxWeight) * 100;
                    @endphp
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-medium text-gray-900">{{ $criterion->name }}</span>
                            <span class="font-bold text-primary-600">{{ number_format($criterion->weight * 100, 2) }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-gradient-to-r from-primary-500 to-primary-600 h-3 rounded-full" style="width: {{ number_format($widthPercent, 2) }}%"></div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Flow Diagram -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-project-diagram text-primary-600 mr-2"></i>
                    Diagram Alur Sistem
                </h3>
                <div class="space-y-6">
                    <div class="flex items-center">
                        <div class="bg-primary-600 text-white w-12 h-12 rounded-full flex items-center justify-center font-bold mr-4">1</div>
                        <div class="flex-1 bg-blue-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-900 mb-1">Input Data Villa</h4>
                            <p class="text-sm text-gray-600">Data villa dan nilai setiap kriteria dimasukkan ke sistem</p>
                        </div>
                    </div>
                    
                    <div class="flex justify-center">
                        <i class="fas fa-arrow-down text-gray-400 text-2xl"></i>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="bg-primary-600 text-white w-12 h-12 rounded-full flex items-center justify-center font-bold mr-4">2</div>
                        <div class="flex-1 bg-green-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-900 mb-1">Perhitungan AHP</h4>
                            <p class="text-sm text-gray-600">Bobot kriteria dihitung menggunakan metode AHP oleh administrator</p>
                        </div>
                    </div>
                    
                    <div class="flex justify-center">
                        <i class="fas fa-arrow-down text-gray-400 text-2xl"></i>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="bg-primary-600 text-white w-12 h-12 rounded-full flex items-center justify-center font-bold mr-4">3</div>
                        <div class="flex-1 bg-purple-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-900 mb-1">Perhitungan TOPSIS</h4>
                            <p class="text-sm text-gray-600">Villa diurutkan menggunakan metode TOPSIS dengan bobot dari AHP</p>
                        </div>
                    </div>
                    
                    <div class="flex justify-center">
                        <i class="fas fa-arrow-down text-gray-400 text-2xl"></i>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="bg-primary-600 text-white w-12 h-12 rounded-full flex items-center justify-center font-bold mr-4">4</div>
                        <div class="flex-1 bg-yellow-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-900 mb-1">Hasil Rekomendasi</h4>
                            <p class="text-sm text-gray-600">Ranking villa terbaik ditampilkan kepada pengguna</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between items-center bg-white rounded-xl shadow-lg p-6">
                <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Beranda
                </a>
                
                <a href="{{ route('user.recommendations.index') }}" class="px-8 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                    <i class="fas fa-star mr-2"></i>
                    Lihat Rekomendasi
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

