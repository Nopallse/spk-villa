<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                    Admin Dashboard
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Kelola sistem rekomendasi villa dan pantau aktivitas pengguna
                </p>
            </div>
            <div class="flex space-x-2">
                <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                    <i class="fas fa-plus mr-2"></i>Tambah Villa
                </button>
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-chart-line mr-2"></i>Laporan
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Villa -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Villa</p>
                            <p class="text-3xl font-bold text-gray-900">52</p>
                            <p class="text-sm text-green-600 mt-1">
                                <i class="fas fa-arrow-up mr-1"></i>+3 bulan ini
                            </p>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-full">
                            <i class="fas fa-home text-purple-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Users -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Pengguna</p>
                            <p class="text-3xl font-bold text-gray-900">1,245</p>
                            <p class="text-sm text-green-600 mt-1">
                                <i class="fas fa-arrow-up mr-1"></i>+125 bulan ini
                            </p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i class="fas fa-users text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Rekomendasi -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Rekomendasi Dibuat</p>
                            <p class="text-3xl font-bold text-gray-900">3,847</p>
                            <p class="text-sm text-green-600 mt-1">
                                <i class="fas fa-arrow-up mr-1"></i>+284 bulan ini
                            </p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <i class="fas fa-chart-line text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Consistency Rate -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Avg. Consistency Ratio</p>
                            <p class="text-3xl font-bold text-gray-900">0.065</p>
                            <p class="text-sm text-green-600 mt-1">
                                <i class="fas fa-check mr-1"></i>95% Valid (CR ≤ 0.1)
                            </p>
                        </div>
                        <div class="bg-yellow-100 p-3 rounded-full">
                            <i class="fas fa-balance-scale text-yellow-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Villa Management -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-cogs text-purple-600 mr-2"></i>
                        Manajemen Villa
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="/admin/villas" class="group flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
                            <div class="bg-purple-100 p-3 rounded-full group-hover:bg-purple-200 transition">
                                <i class="fas fa-home text-purple-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900">Kelola Villa</p>
                                <p class="text-sm text-gray-600">CRUD villa</p>
                            </div>
                        </a>
                        
                        <a href="/admin/criteria" class="group flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                            <div class="bg-blue-100 p-3 rounded-full group-hover:bg-blue-200 transition">
                                <i class="fas fa-list text-blue-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900">Kriteria</p>
                                <p class="text-sm text-gray-600">Kelola kriteria</p>
                            </div>
                        </a>
                        
                        <a href="/admin/values" class="group flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition">
                            <div class="bg-green-100 p-3 rounded-full group-hover:bg-green-200 transition">
                                <i class="fas fa-calculator text-green-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900">Nilai Penilaian</p>
                                <p class="text-sm text-gray-600">Input nilai villa</p>
                            </div>
                        </a>
                        
                        <a href="/admin/calculation" class="group flex items-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition">
                            <div class="bg-yellow-100 p-3 rounded-full group-hover:bg-yellow-200 transition">
                                <i class="fas fa-brain text-yellow-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900">Perhitungan</p>
                                <p class="text-sm text-gray-600">AHP & TOPSIS</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Management -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-users-cog text-blue-600 mr-2"></i>
                        Manajemen Sistem
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="/admin/users" class="group flex items-center p-4 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition">
                            <div class="bg-indigo-100 p-3 rounded-full group-hover:bg-indigo-200 transition">
                                <i class="fas fa-users text-indigo-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900">Pengguna</p>
                                <p class="text-sm text-gray-600">Kelola users</p>
                            </div>
                        </a>
                        
                        <a href="/admin/history" class="group flex items-center p-4 bg-red-50 rounded-lg hover:bg-red-100 transition">
                            <div class="bg-red-100 p-3 rounded-full group-hover:bg-red-200 transition">
                                <i class="fas fa-history text-red-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900">Riwayat</p>
                                <p class="text-sm text-gray-600">Log perhitungan</p>
                            </div>
                        </a>
                        
                        <a href="/admin/reports" class="group flex items-center p-4 bg-teal-50 rounded-lg hover:bg-teal-100 transition">
                            <div class="bg-teal-100 p-3 rounded-full group-hover:bg-teal-200 transition">
                                <i class="fas fa-chart-bar text-teal-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900">Laporan</p>
                                <p class="text-sm text-gray-600">Analytics</p>
                            </div>
                        </a>
                        
                        <a href="/admin/settings" class="group flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div class="bg-gray-100 p-3 rounded-full group-hover:bg-gray-200 transition">
                                <i class="fas fa-cog text-gray-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900">Pengaturan</p>
                                <p class="text-sm text-gray-600">Konfigurasi</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity & Popular Villas -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Activity -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-clock text-green-600 mr-2"></i>
                        Aktivitas Terbaru
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3 p-3 bg-green-50 rounded-lg">
                            <div class="bg-green-100 p-2 rounded-full">
                                <i class="fas fa-home text-green-600 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">Villa "Sleman Paradise" ditambahkan</p>
                                <p class="text-xs text-gray-500">Admin • 2 jam yang lalu</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3 p-3 bg-blue-50 rounded-lg">
                            <div class="bg-blue-100 p-2 rounded-full">
                                <i class="fas fa-user-plus text-blue-600 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">3 pengguna baru mendaftar</p>
                                <p class="text-xs text-gray-500">System • 4 jam yang lalu</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3 p-3 bg-purple-50 rounded-lg">
                            <div class="bg-purple-100 p-2 rounded-full">
                                <i class="fas fa-calculator text-purple-600 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">12 perhitungan rekomendasi dilakukan</p>
                                <p class="text-xs text-gray-500">Users • 6 jam yang lalu</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3 p-3 bg-yellow-50 rounded-lg">
                            <div class="bg-yellow-100 p-2 rounded-full">
                                <i class="fas fa-edit text-yellow-600 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">Kriteria "Fasilitas" diperbarui</p>
                                <p class="text-xs text-gray-500">Admin • 1 hari yang lalu</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <a href="/admin/logs" class="text-purple-600 hover:text-purple-700 text-sm font-medium">
                            Lihat semua aktivitas <i class="fas fa-chevron-right ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Top Performing Villas -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-trophy text-yellow-600 mr-2"></i>
                        Villa Terpopuler
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="bg-yellow-400 text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">1</div>
                                <div>
                                    <p class="font-semibold text-gray-900">Villa Sleman Paradise</p>
                                    <p class="text-sm text-gray-600">Skor rata-rata: 0.847</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-yellow-600 font-semibold">285 rekomendasi</p>
                                <p class="text-xs text-gray-500">bulan ini</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="bg-gray-400 text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">2</div>
                                <div>
                                    <p class="font-semibold text-gray-900">Villa Kaliurang Retreat</p>
                                    <p class="text-sm text-gray-600">Skor rata-rata: 0.756</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-600 font-semibold">201 rekomendasi</p>
                                <p class="text-xs text-gray-500">bulan ini</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-orange-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="bg-orange-400 text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">3</div>
                                <div>
                                    <p class="font-semibold text-gray-900">Villa Prambanan View</p>
                                    <p class="text-sm text-gray-600">Skor rata-rata: 0.689</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-orange-600 font-semibold">178 rekomendasi</p>
                                <p class="text-xs text-gray-500">bulan ini</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="bg-blue-400 text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">4</div>
                                <div>
                                    <p class="font-semibold text-gray-900">Villa Pakem Resort</p>
                                    <p class="text-sm text-gray-600">Skor rata-rata: 0.632</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-blue-600 font-semibold">156 rekomendasi</p>
                                <p class="text-xs text-gray-500">bulan ini</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Usage Statistics -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-chart-line text-blue-600 mr-2"></i>
                        Statistik Penggunaan
                    </h3>
                    <div class="h-64 bg-gray-100 rounded-lg flex items-center justify-center">
                        <!-- Placeholder for Chart.js -->
                        <div class="text-center text-gray-500">
                            <i class="fas fa-chart-line text-4xl mb-2"></i>
                            <p>Grafik Penggunaan Bulanan</p>
                            <p class="text-sm">Rekomendasi yang dibuat per bulan</p>
                        </div>
                    </div>
                </div>

                <!-- Criteria Importance -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-chart-pie text-purple-600 mr-2"></i>
                        Popularitas Kriteria
                    </h3>
                    <div class="h-64 bg-gray-100 rounded-lg flex items-center justify-center">
                        <!-- Placeholder for Chart.js -->
                        <div class="text-center text-gray-500">
                            <i class="fas fa-chart-pie text-4xl mb-2"></i>
                            <p>Pie Chart Kriteria</p>
                            <p class="text-sm">Kriteria paling penting menurut user</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Health -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-heartbeat text-red-600 mr-2"></i>
                    Status Sistem
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="text-center">
                        <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-database text-green-600 text-2xl"></i>
                        </div>
                        <h4 class="font-semibold text-gray-900">Database</h4>
                        <p class="text-green-600 font-medium">Online</p>
                        <p class="text-sm text-gray-500">99.9% uptime</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-server text-green-600 text-2xl"></i>
                        </div>
                        <h4 class="font-semibold text-gray-900">Server</h4>
                        <p class="text-green-600 font-medium">Healthy</p>
                        <p class="text-sm text-gray-500">CPU: 45%</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="bg-yellow-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-memory text-yellow-600 text-2xl"></i>
                        </div>
                        <h4 class="font-semibold text-gray-900">Memory</h4>
                        <p class="text-yellow-600 font-medium">Warning</p>
                        <p class="text-sm text-gray-500">RAM: 78%</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-shield-alt text-green-600 text-2xl"></i>
                        </div>
                        <h4 class="font-semibold text-gray-900">Security</h4>
                        <p class="text-green-600 font-medium">Secure</p>
                        <p class="text-sm text-gray-500">SSL Active</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-refresh system stats every 30 seconds
            setInterval(() => {
                console.log('Refreshing system stats...');
                // In real implementation, make AJAX call to refresh stats
            }, 30000);
        });
    </script>
</x-app-layout>