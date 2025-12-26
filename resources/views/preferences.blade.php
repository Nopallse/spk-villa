<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                    Informasi Bobot Kriteria
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Bobot kriteria sudah diatur oleh administrator melalui perhitungan AHP
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Info Card -->
            <div class="bg-blue-50 border-l-4 border-blue-400 p-6 mb-8">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-600 text-xl mr-3 mt-1"></i>
                    <div>
                        <h3 class="text-lg font-semibold text-blue-900 mb-2">Bobot Kriteria Sudah Ditetapkan</h3>
                        <p class="text-blue-800 mb-3">
                            Administrator telah mengatur bobot kriteria melalui perhitungan AHP (Analytical Hierarchy Process). 
                            Anda tidak perlu mengatur ulang bobot kriteria. Sistem akan menggunakan bobot yang sudah ditentukan untuk menghitung rekomendasi villa.
                        </p>
                        <a href="{{ route('user.recommendations.index') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition mt-3">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Lihat Rekomendasi Villa
                        </a>
                    </div>
                </div>
            </div>

            <!-- Criteria Weights Display -->
            @php
                $criteria = \App\Models\Criteria::active()->ordered()->get();
            @endphp
            
            @if(count($criteria) > 0)
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h3 class="text-xl font-semibold text-gray-900 mb-6">
                    <i class="fas fa-weight text-primary-600 mr-2"></i>
                    Bobot Kriteria yang Digunakan
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
                                <span class="font-bold text-primary-600 text-xl">
                                    {{ $criterion->weight ? number_format($criterion->weight * 100, 2) : 'N/A' }}%
                                </span>
                                @if($criterion->weight)
                                <p class="text-xs text-gray-500">Bobot: {{ number_format($criterion->weight, 4) }}</p>
                                @endif
                            </div>
                        </div>
                        @if($criterion->weight)
                        <div class="flex items-center space-x-3 mt-3">
                            <div class="flex-1 bg-gray-200 rounded-full h-3">
                                @php
                                    $maxWeight = $criteria->max('weight') ?? 1;
                                    $widthPercent = ($criterion->weight / $maxWeight) * 100;
                                @endphp
                                <div class="bg-gradient-to-r from-primary-500 to-primary-600 h-3 rounded-full transition-all duration-500" style="width: {{ number_format($widthPercent, 2) }}%"></div>
                            </div>
                        </div>
                        @else
                        <p class="text-sm text-yellow-600 mt-2">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            Bobot belum diatur oleh administrator
                        </p>
                        @endif
                    </div>
                    @endforeach
                </div>
                
                @php
                    $totalWeight = $criteria->sum('weight');
                    $hasAllWeights = $criteria->every(function($c) { return $c->weight !== null; });
                @endphp
                
                @if($hasAllWeights)
                <div class="mt-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 mr-2"></i>
                        <span class="text-sm text-green-800">
                            Total bobot: <strong>{{ number_format($totalWeight, 4) }}</strong> 
                            @if(abs($totalWeight - 1.0) < 0.01)
                                (Normalisasi benar)
                            @else
                                (Perlu normalisasi)
                            @endif
                        </span>
                    </div>
                </div>
                @endif
            </div>
            @else
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 mb-8">
                <div class="flex">
                    <i class="fas fa-exclamation-triangle text-yellow-400 text-xl mr-3"></i>
                    <div>
                        <p class="text-yellow-800">Belum ada kriteria yang tersedia. Silakan hubungi administrator.</p>
                    </div>
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
                    Lihat Rekomendasi Villa
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
