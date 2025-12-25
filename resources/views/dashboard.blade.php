<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                    Dashboard VillaSleman
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Sistem Pendukung Keputusan Rekomendasi Villa di Kabupaten Sleman
                </p>
            </div>
            <div class="flex items-center space-x-3">
                <div class="text-right">
                    <p class="text-sm text-gray-500">{{ now()->format('l, d F Y') }}</p>
                    <p class="text-xs text-gray-400">{{ now()->format('H:i') }} WIB</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-primary-600 to-primary-500 rounded-2xl p-8 text-white shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h3>
                        <p class="text-primary-100 text-lg">
                            @if(auth()->user()->role === 'admin')
                                Kelola sistem dan pantau aktivitas pengguna dengan mudah
                            @else
                                Temukan villa impian Anda dengan sistem rekomendasi berbasis AHP & TOPSIS
                            @endif
                        </p>
                        <div class="mt-4 flex space-x-4">
                            @if(auth()->user()->role === 'admin')
                                <a href="#" class="bg-white text-primary-600 px-6 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">
                                    <i class="fas fa-cog mr-2"></i>Kelola Villa
                                </a>
                            @else
                                <a href="#" class="bg-white text-primary-600 px-6 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">
                                    <i class="fas fa-search mr-2"></i>Cari Villa
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <i class="fas fa-home text-8xl text-white opacity-20"></i>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Villas -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-primary-600">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary-100 p-3 rounded-full">
                                <i class="fas fa-home text-primary-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Villa</p>
                            <p class="text-2xl font-bold text-gray-900">52</p>
                            <p class="text-sm text-green-600">
                                <i class="fas fa-arrow-up mr-1"></i>+3 bulan ini
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Total Users -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-primary-500">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary-100 p-3 rounded-full">
                                <i class="fas fa-users text-primary-500 text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Pengguna</p>
                            <p class="text-2xl font-bold text-gray-900">1,245</p>
                            <p class="text-sm text-green-600">
                                <i class="fas fa-arrow-up mr-1"></i>+125 bulan ini
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Rekomendasi Dibuat -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-primary-400">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary-100 p-3 rounded-full">
                                <i class="fas fa-chart-line text-primary-400 text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Rekomendasi</p>
                            <p class="text-2xl font-bold text-gray-900">3,847</p>
                            <p class="text-sm text-green-600">
                                <i class="fas fa-arrow-up mr-1"></i>+284 bulan ini
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Rating Rata-rata -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-600">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-yellow-100 p-3 rounded-full">
                                <i class="fas fa-star text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Rating Rata-rata</p>
                            <p class="text-2xl font-bold text-gray-900">4.8</p>
                            <p class="text-sm text-green-600">
                                <i class="fas fa-arrow-up mr-1"></i>+0.2 bulan ini
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- User Quick Actions -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-bolt text-primary-600 mr-2"></i>
                        Aksi Cepat
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <a href="#" class="group flex items-center p-4 bg-primary-50 rounded-lg hover:bg-primary-100 transition">
                            <div class="bg-primary-100 p-3 rounded-full group-hover:bg-primary-200 transition">
                                <i class="fas fa-search text-primary-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900">Cari Villa</p>
                                <p class="text-sm text-gray-600">Mulai pencarian villa</p>
                            </div>
                        </a>
                        
                        <a href="#" class="group flex items-center p-4 bg-primary-50 rounded-lg hover:bg-primary-100 transition">
                            <div class="bg-primary-100 p-3 rounded-full group-hover:bg-primary-200 transition">
                                <i class="fas fa-sliders-h text-primary-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900">Set Preferensi</p>
                                <p class="text-sm text-gray-600">Atur kriteria pilihan</p>
                            </div>
                        </a>
                        
                        <a href="#" class="group flex items-center p-4 bg-primary-50 rounded-lg hover:bg-primary-100 transition">
                            <div class="bg-primary-100 p-3 rounded-full group-hover:bg-primary-200 transition">
                                <i class="fas fa-list text-primary-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900">Lihat Rekomendasi</p>
                                <p class="text-sm text-gray-600">Hasil perhitungan AHP</p>
                            </div>
                        </a>
                        
                        <a href="#" class="group flex items-center p-4 bg-primary-50 rounded-lg hover:bg-primary-100 transition">
                            <div class="bg-primary-100 p-3 rounded-full group-hover:bg-primary-200 transition">
                                <i class="fas fa-history text-primary-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900">Riwayat</p>
                                <p class="text-sm text-gray-600">Lihat pencarian lama</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-clock text-primary-600 mr-2"></i>
                        Aktivitas Terbaru
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                            <div class="bg-green-100 p-2 rounded-full">
                                <i class="fas fa-check text-green-600 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">Rekomendasi villa berhasil dibuat</p>
                                <p class="text-xs text-gray-500">2 jam yang lalu</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                            <div class="bg-blue-100 p-2 rounded-full">
                                <i class="fas fa-user text-blue-600 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">Profil berhasil diperbarui</p>
                                <p class="text-xs text-gray-500">1 hari yang lalu</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                            <div class="bg-purple-100 p-2 rounded-full">
                                <i class="fas fa-home text-purple-600 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">Melihat detail Villa Prambanan View</p>
                                <p class="text-xs text-gray-500">3 hari yang lalu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Villa Populer -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900">
                        <i class="fas fa-fire text-orange-600 mr-2"></i>
                        Villa Paling Populer
                    </h3>
                    <a href="#" class="text-primary-600 hover:text-primary-700 text-sm font-semibold">
                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Villa 1 -->
                    <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition">
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                             alt="Villa Paradise" 
                             class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-900 mb-1">Villa Sleman Paradise</h4>
                            <p class="text-sm text-gray-600 mb-2">Pemandangan Gunung Merapi</p>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-primary-600">Rp 850K</span>
                                <div class="flex items-center text-sm text-yellow-600">
                                    <i class="fas fa-star mr-1"></i>
                                    4.9 (12)
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Villa 2 -->
                    <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition">
                        <img src="https://images.unsplash.com/photo-1613490493576-7fde63acd811?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                             alt="Villa Prambanan" 
                             class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-900 mb-1">Villa Prambanan View</h4>
                            <p class="text-sm text-gray-600 mb-2">Dekat Candi Prambanan</p>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-primary-600">Rp 650K</span>
                                <div class="flex items-center text-sm text-yellow-600">
                                    <i class="fas fa-star mr-1"></i>
                                    4.7 (8)
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Villa 3 -->
                    <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition">
                        <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                             alt="Villa Kaliurang" 
                             class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-900 mb-1">Villa Kaliurang Retreat</h4>
                            <p class="text-sm text-gray-600 mb-2">Suasana pegunungan sejuk</p>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-primary-600">Rp 750K</span>
                                <div class="flex items-center text-sm text-yellow-600">
                                    <i class="fas fa-star mr-1"></i>
                                    4.8 (15)
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Metode Perhitungan -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- AHP Method -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">
                        <i class="fas fa-brain text-primary-600 mr-2"></i>
                        Metode AHP
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Analytical Hierarchy Process untuk menentukan bobot kriteria berdasarkan preferensi Anda.
                    </p>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-600 mr-2"></i>
                            <span class="text-sm text-gray-700">Perbandingan berpasangan kriteria</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-600 mr-2"></i>
                            <span class="text-sm text-gray-700">Perhitungan bobot prioritas</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-600 mr-2"></i>
                            <span class="text-sm text-gray-700">Uji konsistensi (CR ≤ 0.1)</span>
                        </div>
                    </div>
                    <button class="mt-4 w-full bg-primary-600 text-white py-2 rounded-lg hover:bg-primary-700 transition">
                        Pelajari AHP
                    </button>
                </div>

                <!-- TOPSIS Method -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">
                        <i class="fas fa-chart-line text-primary-500 mr-2"></i>
                        Metode TOPSIS
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Technique for Order Preference by Similarity to Ideal Solution untuk ranking villa.
                    </p>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-600 mr-2"></i>
                            <span class="text-sm text-gray-700">Normalisasi matriks keputusan</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-600 mr-2"></i>
                            <span class="text-sm text-gray-700">Solusi ideal positif & negatif</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-600 mr-2"></i>
                            <span class="text-sm text-gray-700">Closeness coefficient ranking</span>
                        </div>
                    </div>
                    <button class="mt-4 w-full bg-primary-500 text-white py-2 rounded-lg hover:bg-primary-600 transition">
                        Pelajari TOPSIS
                    </button>
                </div>
            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m0 0h4m0 0h3a1 1 0 001-1V10M9 21h6"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Total Villa</h3>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_villas'] ?? 25 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Users -->
                @if(auth()->user()->role === 'admin')
                <div class="stats-card">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Total User</h3>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_users'] ?? 148 }}</p>
                        </div>
                    </div>
                </div>
                @else
                <!-- Recommendations -->
                <div class="stats-card">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Rekomendasi</h3>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['user_recommendations'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Active Calculations -->
                <div class="stats-card">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">
                                @if(auth()->user()->role === 'admin')
                                    Total Perhitungan
                                @else
                                    Perhitungan Anda
                                @endif
                            </h3>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_calculations'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- System Status -->
                <div class="stats-card">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Status Sistem</h3>
                            <p class="text-lg font-bold text-emerald-600">Online</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions & Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Quick Actions -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-lg font-semibold text-gray-900">Aksi Cepat</h3>
                        <p class="text-sm text-gray-600">Fitur yang sering digunakan</p>
                    </div>
                    <div class="card-body">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.villas.create') }}" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors group">
                                    <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Tambah Villa</p>
                                        <p class="text-xs text-gray-500">Tambah villa baru</p>
                                    </div>
                                </a>

                                <a href="{{ route('admin.users.index') }}" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors group">
                                    <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Kelola User</p>
                                        <p class="text-xs text-gray-500">Manajemen user</p>
                                    </div>
                                </a>

                                <a href="{{ route('admin.criteria.index') }}" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors group">
                                    <div class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Kelola Kriteria</p>
                                        <p class="text-xs text-gray-500">Atur kriteria penilaian</p>
                                    </div>
                                </a>

                                <a href="{{ route('admin.calculations.index') }}" class="flex items-center p-4 bg-orange-50 rounded-lg hover:bg-orange-100 transition-colors group">
                                    <div class="flex-shrink-0 w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center group-hover:bg-orange-200">
                                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Lihat Laporan</p>
                                        <p class="text-xs text-gray-500">Riwayat perhitungan</p>
                                    </div>
                                </a>
                            @else
                                <a href="{{ route('user.villas.index') }}" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors group">
                                    <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m0 0h4m0 0h3a1 1 0 001-1V10M9 21h6"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Lihat Villa</p>
                                        <p class="text-xs text-gray-500">Jelajahi villa tersedia</p>
                                    </div>
                                </a>

                                <a href="{{ route('user.preferences.index') }}" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors group">
                                    <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Input Preferensi</p>
                                        <p class="text-xs text-gray-500">Atur kriteria pilihan</p>
                                    </div>
                                </a>

                                <a href="{{ route('user.comparison.index') }}" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors group">
                                    <div class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Perbandingan AHP</p>
                                        <p class="text-xs text-gray-500">Analisis kriteria</p>
                                    </div>
                                </a>

                                <a href="{{ route('user.recommendations.index') }}" class="flex items-center p-4 bg-orange-50 rounded-lg hover:bg-orange-100 transition-colors group">
                                    <div class="flex-shrink-0 w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center group-hover:bg-orange-200">
                                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Lihat Rekomendasi</p>
                                        <p class="text-xs text-gray-500">Hasil analisis TOPSIS</p>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-lg font-semibold text-gray-900">Aktivitas Terbaru</h3>
                        <p class="text-sm text-gray-600">Aktivitas sistem terkini</p>
                    </div>
                    <div class="card-body">
                        <div class="flow-root">
                            <ul class="-mb-8">
                                @forelse($recent_activities ?? [] as $activity)
                                <li>
                                    <div class="relative pb-8">
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                        <div class="relative flex space-x-3">
                                            <div>
                                                <span class="bg-blue-500 h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white">
                                                    <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                <div>
                                                    <p class="text-sm text-gray-500">{{ $activity['description'] }}</p>
                                                </div>
                                                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                    {{ $activity['time'] }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @empty
                                <li class="text-center py-8">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada aktivitas</h3>
                                    <p class="mt-1 text-sm text-gray-500">Mulai menggunakan sistem untuk melihat aktivitas terbaru</p>
                                </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Info Panel (Admin Only) -->
            @if(auth()->user()->role === 'admin')
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Sistem</h3>
                    <p class="text-sm text-gray-600">Status dan performa sistem</p>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-600">{{ $system_info['php_version'] ?? '8.2.0' }}</div>
                            <div class="text-sm text-gray-500">PHP Version</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600">{{ $system_info['laravel_version'] ?? '11.0' }}</div>
                            <div class="text-sm text-gray-500">Laravel Version</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-purple-600">{{ $system_info['database_size'] ?? '2.3 MB' }}</div>
                            <div class="text-sm text-gray-500">Database Size</div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
