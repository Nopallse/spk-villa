<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                    Informasi Perbandingan AHP
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Bobot kriteria sudah dihitung oleh administrator melalui perbandingan berpasangan AHP
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Info Card -->
            <div class="bg-green-50 border-l-4 border-green-400 p-6 mb-8">
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-600 text-xl mr-3 mt-1"></i>
                    <div>
                        <h3 class="text-lg font-semibold text-green-900 mb-2">Bobot AHP Sudah Dihitung</h3>
                        <p class="text-green-800 mb-3">
                            Administrator telah melakukan perbandingan berpasangan AHP dan menghitung bobot kriteria. 
                            Sistem menggunakan bobot ini untuk menghitung rekomendasi villa. Anda tidak perlu melakukan perbandingan ulang.
                        </p>
                        <a href="{{ route('user.recommendations.index') }}" class="inline-block bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition mt-3">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Lihat Rekomendasi Villa
                        </a>
                    </div>
                </div>
            </div>

            @php
                $criteria = \App\Models\Criteria::active()->ordered()->get();
            @endphp

            @if(count($criteria) < 2)
            <!-- Warning if not enough criteria -->
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 mb-8">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-yellow-400 text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            <strong>Perhatian:</strong> Minimal diperlukan 2 kriteria aktif untuk melakukan perbandingan AHP.
                            Silakan hubungi administrator.
                        </p>
                            </div>
                            </div>
                        </div>
            @else

            <!-- Status Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-primary-600">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary-100 p-3 rounded-full">
                                <i class="fas fa-list text-primary-600 text-xl"></i>
                        </div>
                            </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Kriteria</p>
                            <p class="text-2xl font-bold text-gray-900">{{ count($criteria) }}</p>
                            </div>
                        </div>
                    </div>
                    
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-600">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-blue-100 p-3 rounded-full">
                                <i class="fas fa-check-circle text-blue-600 text-xl"></i>
                    </div>
                </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Status</p>
                            <p class="text-lg font-bold text-green-600">Selesai</p>
                            <p class="text-xs text-gray-500">Diatur oleh admin</p>
                            </div>
                        </div>
                    </div>
                    
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-600">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-balance-scale text-green-600 text-xl"></i>
                    </div>
                </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Bobot Tersedia</p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ $criteria->whereNotNull('weight')->count() }}/{{ count($criteria) }}
                            </p>
                            </div>
                        </div>
                    </div>
                    
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-orange-600">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-orange-100 p-3 rounded-full">
                                <i class="fas fa-chart-line text-orange-600 text-xl"></i>
                    </div>
                </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Sumber Bobot</p>
                            <p class="text-lg font-bold text-gray-600">Admin</p>
                        </div>
                        </div>
                    </div>
                </div>

            <!-- Criteria Weights Display -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h3 class="text-xl font-semibold text-gray-900 mb-6">
                    <i class="fas fa-weight text-primary-600 mr-2"></i>
                    Bobot Kriteria Hasil AHP
                    </h3>
                <div class="space-y-4">
                    @foreach($criteria as $index => $criterion)
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center">
                                <div class="bg-primary-100 p-2 rounded-full mr-3">
                                    <i class="fas fa-{{ ['dollar-sign', 'map-marker-alt', 'swimming-pool', 'sparkles', 'star', 'users'][$index % 6] }} text-primary-600"></i>
                                </div>
                                <span class="font-medium text-gray-900">{{ $criterion->name }}</span>
                            </div>
                            <div class="text-right">
                                @if($criterion->weight)
                                <span class="font-bold text-primary-600 text-xl">{{ number_format($criterion->weight * 100, 2) }}%</span>
                                <p class="text-xs text-gray-500">Bobot: {{ number_format($criterion->weight, 4) }}</p>
                                @else
                                <span class="text-gray-400">Belum diatur</span>
                                @endif
                            </div>
                        </div>
                        @if($criterion->weight)
                        @php
                            $maxWeight = $criteria->max('weight') ?? 1;
                            $widthPercent = ($criterion->weight / $maxWeight) * 100;
                        @endphp
                        <div class="flex items-center space-x-3 mt-3">
                            <div class="flex-1 bg-gray-200 rounded-full h-3">
                                <div class="bg-gradient-to-r from-primary-500 to-primary-600 h-3 rounded-full transition-all duration-500" style="width: {{ number_format($widthPercent, 2) }}%"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endforeach
                    </div>
                </div>

            @endif

                <!-- Action Buttons -->
                <div class="flex justify-between items-center bg-white rounded-xl shadow-lg p-6">
                <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Dashboard
                </a>
                
                <a href="{{ route('user.recommendations.index') }}" class="px-8 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Lihat Hasil Rekomendasi
                </a>
                    </div>
        </div>
    </div>
</x-app-layout>
