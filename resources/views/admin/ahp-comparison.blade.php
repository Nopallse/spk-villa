@extends('layouts.admin')

@section('page-title', 'Analisis Hierarki Proses (AHP)')
@section('page-description', 'Perbandingan berpasangan kriteria untuk menentukan bobot prioritas')

@section('content')
<!-- Status & Info Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-primary-600">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="bg-primary-100 p-3 rounded-full">
                    <i class="fas fa-balance-scale text-primary-600 text-xl"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Total Kriteria</p>
                <p class="text-2xl font-bold text-gray-900" id="totalCriteria">{{ count($criteria) }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-600">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-calculator text-blue-600 text-xl"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Progress Perbandingan</p>
                <p class="text-2xl font-bold text-gray-900">{{ $totalComparisons }}/{{ count($criteria) * (count($criteria) - 1) / 2 }}</p>
                @php
                    $progressPercent = count($criteria) > 1 ? ($totalComparisons / (count($criteria) * (count($criteria) - 1) / 2)) * 100 : 0;
                @endphp
                <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                    <div class="bg-blue-600 h-2 rounded-full transition-all" style="width: {{ number_format($progressPercent, 1) }}%"></div>
                </div>
                <p class="text-xs text-gray-500 mt-1">{{ number_format($progressPercent, 1) }}% selesai</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-600">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Consistency Ratio</p>
                <p class="text-2xl font-bold text-gray-900" id="consistencyRatio">{{ $consistencyRatio ?? 'N/A' }}</p>
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
                <p class="text-sm font-medium text-gray-500">Status</p>
                <p class="text-lg font-bold" id="consistencyStatus">
                    @if($consistencyRatio !== null && $consistencyRatio <= 0.1)
                        <span class="text-green-600">Konsisten</span>
                    @elseif($consistencyRatio !== null)
                        <span class="text-red-600">Tidak Konsisten</span>
                    @else
                        <span class="text-gray-600">Belum Selesai</span>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>

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
                <a href="{{ route('admin.criteria.index') }}" class="font-medium underline hover:text-yellow-800">
                    Kelola kriteria disini.
                </a>
            </p>
        </div>
    </div>
</div>
@else

<!-- AHP Instructions -->
<div class="bg-blue-50 border-l-4 border-blue-400 p-6 mb-8">
    <div class="flex">
        <div class="flex-shrink-0">
            <i class="fas fa-info-circle text-blue-400 text-xl"></i>
        </div>
        <div class="ml-3">
            <h3 class="text-lg font-medium text-blue-800">Panduan Perbandingan Berpasangan (AHP)</h3>
            <div class="mt-2 text-sm text-blue-700">
                <p class="mb-2">Gunakan skala Saaty untuk membandingkan tingkat kepentingan antar kriteria:</p>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-2 text-xs">
                    <span class="bg-blue-100 px-2 py-1 rounded"><strong>1</strong> - Sama penting</span>
                    <span class="bg-blue-100 px-2 py-1 rounded"><strong>3</strong> - Sedikit lebih penting</span>
                    <span class="bg-blue-100 px-2 py-1 rounded"><strong>5</strong> - Lebih penting</span>
                    <span class="bg-blue-100 px-2 py-1 rounded"><strong>7</strong> - Sangat penting</span>
                    <span class="bg-blue-100 px-2 py-1 rounded"><strong>9</strong> - Mutlak lebih penting</span>
                </div>
                <p class="mt-2"><em>Nilai 2, 4, 6, 8 dapat digunakan untuk nilai tengah.</em></p>
                <div class="mt-3 p-3 bg-blue-200 rounded-lg">
                    <p class="font-medium text-blue-900">📊 Hasil Perhitungan:</p>
                    <p class="text-xs mt-1">Sistem akan otomatis menghitung dan menampilkan hasil secara real-time!</p>
                    <ul class="text-xs mt-1 space-y-1 ml-4">
                        <li>• <strong>Matrix Normalisasi</strong> - Proses standarisasi nilai perbandingan</li>
                        <li>• <strong>Eigenvector</strong> - Bobot prioritas dari setiap kriteria</li>
                        <li>• <strong>Lambda Max (λmax)</strong> - Nilai eigen maksimum untuk konsistensi</li>
                        <li>• <strong>Consistency Index (CI)</strong> - Indeks inkonsistensi matrix</li>
                        <li>• <strong>Consistency Ratio (CR)</strong> - Rasio konsistensi (harus ≤ 0.1)</li>
                        <li>• <strong>Random Index (RI)</strong> - Nilai acak berdasarkan ukuran matrix</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pairwise Comparison Matrix -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">
                <i class="fas fa-table mr-2 text-primary-600"></i>
                Matriks Perbandingan Berpasangan
            </h3>
            <div class="flex items-center space-x-3">
                <button onclick="resetComparisons()" class="text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 px-4 py-2 rounded-lg transition-colors">
                    <i class="fas fa-redo mr-2"></i>
                    Reset Matriks
                </button>
            </div>
        </div>
    </div>

    <div class="p-6">
        <!-- Real-time Matrix Status -->
        <div id="matrixStatus" class="mb-4 p-4 bg-gray-50 border border-gray-200 rounded-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-info-circle text-gray-600"></i>
                    <span class="font-medium text-gray-800">Status Matrix:</span>
                    <span id="matrixProgress" class="text-sm text-gray-600">Menunggu input perbandingan...</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-xs text-gray-500">Simetri:</span>
                    <div id="symmetryIndicator" class="w-3 h-3 rounded-full bg-gray-300"></div>
                </div>
            </div>
        </div>

        <form id="comparisonForm" action="{{ route('admin.ahp-comparison.save') }}" method="POST">
            @csrf
            
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">Kriteria</th>
                            @foreach($criteria as $criterion)
                            <th class="border border-gray-300 px-4 py-3 text-center text-sm font-medium text-gray-700">
                                {{ $criterion->name }}
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($criteria as $i => $criterionA)
                        <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                            <td class="border border-gray-300 px-4 py-3 font-medium text-gray-900">
                                {{ $criterionA->name }}
                            </td>
                            @foreach($criteria as $j => $criterionB)
                            <td class="border border-gray-300 px-4 py-3 text-center">
                                @if($i == $j)
                                    <!-- Diagonal: always 1 -->
                                    <span class="text-gray-600 font-semibold">1</span>
                                    <input type="hidden" name="comparison[{{ $criterionA->id }}][{{ $criterionB->id }}]" value="1">
                                @elseif($i < $j)
                                    <!-- Upper triangle: input fields -->
                                    <select name="comparison[{{ $criterionA->id }}][{{ $criterionB->id }}]" 
                                            class="comparison-input w-20 text-center border border-gray-300 rounded px-2 py-1 focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                            data-row="{{ $criterionA->id }}" 
                                            data-col="{{ $criterionB->id }}"
                                            onchange="updateMatrix(this)">
                                        <option value="">-</option>
                                        <option value="9" {{ (isset($comparisons[$criterionA->id][$criterionB->id]) && $comparisons[$criterionA->id][$criterionB->id] == 9) ? 'selected' : '' }}>9</option>
                                        <option value="8" {{ (isset($comparisons[$criterionA->id][$criterionB->id]) && $comparisons[$criterionA->id][$criterionB->id] == 8) ? 'selected' : '' }}>8</option>
                                        <option value="7" {{ (isset($comparisons[$criterionA->id][$criterionB->id]) && $comparisons[$criterionA->id][$criterionB->id] == 7) ? 'selected' : '' }}>7</option>
                                        <option value="6" {{ (isset($comparisons[$criterionA->id][$criterionB->id]) && $comparisons[$criterionA->id][$criterionB->id] == 6) ? 'selected' : '' }}>6</option>
                                        <option value="5" {{ (isset($comparisons[$criterionA->id][$criterionB->id]) && $comparisons[$criterionA->id][$criterionB->id] == 5) ? 'selected' : '' }}>5</option>
                                        <option value="4" {{ (isset($comparisons[$criterionA->id][$criterionB->id]) && $comparisons[$criterionA->id][$criterionB->id] == 4) ? 'selected' : '' }}>4</option>
                                        <option value="3" {{ (isset($comparisons[$criterionA->id][$criterionB->id]) && $comparisons[$criterionA->id][$criterionB->id] == 3) ? 'selected' : '' }}>3</option>
                                        <option value="2" {{ (isset($comparisons[$criterionA->id][$criterionB->id]) && $comparisons[$criterionA->id][$criterionB->id] == 2) ? 'selected' : '' }}>2</option>
                                        <option value="1" {{ (isset($comparisons[$criterionA->id][$criterionB->id]) && $comparisons[$criterionA->id][$criterionB->id] == 1) ? 'selected' : '' }}>1</option>
                                        <option value="0.5" {{ (isset($comparisons[$criterionA->id][$criterionB->id]) && abs($comparisons[$criterionA->id][$criterionB->id] - 0.5) < 0.01) ? 'selected' : '' }}>1/2</option>
                                        <option value="0.333333" {{ (isset($comparisons[$criterionA->id][$criterionB->id]) && (abs($comparisons[$criterionA->id][$criterionB->id] - 0.33) < 0.01 || abs($comparisons[$criterionA->id][$criterionB->id] - 0.333) < 0.01 || abs($comparisons[$criterionA->id][$criterionB->id] - 0.333333) < 0.01)) ? 'selected' : '' }}>1/3</option>
                                        <option value="0.25" {{ (isset($comparisons[$criterionA->id][$criterionB->id]) && abs($comparisons[$criterionA->id][$criterionB->id] - 0.25) < 0.01) ? 'selected' : '' }}>1/4</option>
                                        <option value="0.2" {{ (isset($comparisons[$criterionA->id][$criterionB->id]) && abs($comparisons[$criterionA->id][$criterionB->id] - 0.2) < 0.01) ? 'selected' : '' }}>1/5</option>
                                        <option value="0.166667" {{ (isset($comparisons[$criterionA->id][$criterionB->id]) && (abs($comparisons[$criterionA->id][$criterionB->id] - 0.17) < 0.01 || abs($comparisons[$criterionA->id][$criterionB->id] - 0.166667) < 0.01)) ? 'selected' : '' }}>1/6</option>
                                        <option value="0.142857" {{ (isset($comparisons[$criterionA->id][$criterionB->id]) && (abs($comparisons[$criterionA->id][$criterionB->id] - 0.14) < 0.01 || abs($comparisons[$criterionA->id][$criterionB->id] - 0.142857) < 0.01)) ? 'selected' : '' }}>1/7</option>
                                        <option value="0.125" {{ (isset($comparisons[$criterionA->id][$criterionB->id]) && abs($comparisons[$criterionA->id][$criterionB->id] - 0.125) < 0.01) ? 'selected' : '' }}>1/8</option>
                                        <option value="0.111111" {{ (isset($comparisons[$criterionA->id][$criterionB->id]) && (abs($comparisons[$criterionA->id][$criterionB->id] - 0.11) < 0.01 || abs($comparisons[$criterionA->id][$criterionB->id] - 0.111111) < 0.01)) ? 'selected' : '' }}>1/9</option>
                                    </select>
                                @else
                                    <!-- Lower triangle: reciprocal values -->
                                    @php
                                        $reciprocalValue = null;
                                        if (isset($comparisons[$criterionB->id][$criterionA->id]) && $comparisons[$criterionB->id][$criterionA->id] > 0) {
                                            $originalValue = floatval($comparisons[$criterionB->id][$criterionA->id]);
                                            
                                            // Map common fractional values to their integer reciprocals
                                            // This prevents floating point precision issues
                                            $fractionMap = [
                                                0.111111 => 9,      // 1/9
                                                0.11 => 9,          // 1/9 (rounded)
                                                0.125 => 8,         // 1/8
                                                0.142857 => 7,      // 1/7
                                                0.14 => 7,          // 1/7 (rounded)
                                                0.166667 => 6,      // 1/6
                                                0.17 => 6,          // 1/6 (rounded)
                                                0.2 => 5,           // 1/5
                                                0.25 => 4,          // 1/4
                                                0.333333 => 3,      // 1/3 (exact)
                                                0.333 => 3,         // 1/3 (rounded)
                                                0.33 => 3,          // 1/3 (rounded)
                                                0.5 => 2,           // 1/2
                                            ];
                                            
                                            // Check if original value matches a known fraction
                                            $found = false;
                                            foreach ($fractionMap as $fraction => $reciprocal) {
                                                if (abs($originalValue - $fraction) < 0.01) {
                                                    $reciprocalValue = $reciprocal;
                                                    $found = true;
                                                    break;
                                                }
                                            }
                                            
                                            // If not found in map, calculate reciprocal normally
                                            if (!$found) {
                                                $reciprocalValue = 1 / $originalValue;
                                                // Round to nearest integer if very close
                                                $rounded = round($reciprocalValue);
                                                if (abs($reciprocalValue - $rounded) < 0.001) {
                                                    $reciprocalValue = $rounded;
                                                }
                                            }
                                        }
                                    @endphp
                                    <span class="text-gray-600 reciprocal-value" 
                                          id="reciprocal-{{ $criterionB->id }}-{{ $criterionA->id }}">
                                        @if($reciprocalValue !== null)
                                            @if($reciprocalValue == intval($reciprocalValue))
                                                {{ intval($reciprocalValue) }}
                                            @else
                                                {{ number_format($reciprocalValue, 3, '.', '') }}
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </span>
                                    <input type="hidden" name="comparison[{{ $criterionA->id }}][{{ $criterionB->id }}]" 
                                           id="hidden-{{ $criterionA->id }}-{{ $criterionB->id }}"
                                           value="{{ $reciprocalValue !== null ? number_format($reciprocalValue, 6, '.', '') : '' }}">
                                @endif
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <button type="submit" onclick="return validateAndSubmit(event)" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-lg transition-colors">
                    <i class="fas fa-calculator mr-2"></i>
                    Simpan & Hitung Bobot
                </button>
            </div>
        </form>
    </div>
</div>

@if(isset($weights) && count($weights) > 0)
<!-- Results Section -->
<div class="mb-8">
    <!-- Calculation Steps Overview -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-6 mb-6">
        <h3 class="text-lg font-semibold text-blue-900 mb-4">
            <i class="fas fa-cogs mr-2"></i>
            Proses Perhitungan AHP Berhasil!
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-sm">
            <div class="bg-white rounded-lg p-4 border border-blue-200">
                <div class="text-blue-600 font-semibold mb-1">Langkah 1</div>
                <div class="text-gray-700">Normalisasi Matrix</div>
                <div class="text-xs text-gray-500 mt-1">✓ Selesai</div>
            </div>
            <div class="bg-white rounded-lg p-4 border border-blue-200">
                <div class="text-blue-600 font-semibold mb-1">Langkah 2</div>
                <div class="text-gray-700">Hitung Eigenvector</div>
                <div class="text-xs text-gray-500 mt-1">✓ Selesai</div>
            </div>
            <div class="bg-white rounded-lg p-4 border border-blue-200">
                <div class="text-blue-600 font-semibold mb-1">Langkah 3</div>
                <div class="text-gray-700">Uji Konsistensi</div>
                <div class="text-xs text-gray-500 mt-1">✓ Selesai</div>
            </div>
            <div class="bg-white rounded-lg p-4 border border-blue-200">
                <div class="text-blue-600 font-semibold mb-1">Hasil</div>
                <div class="text-gray-700">{{ $consistencyRatio <= 0.1 ? 'Konsisten' : 'Tidak Konsisten' }}</div>
                <div class="text-xs {{ $consistencyRatio <= 0.1 ? 'text-green-500' : 'text-red-500' }} mt-1">
                    {{ $consistencyRatio <= 0.1 ? '✓ Valid' : '✗ Revisi' }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    <!-- Weights Results -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">
                <i class="fas fa-weight-hanging mr-2 text-primary-600"></i>
                Bobot Prioritas (Eigenvector)
            </h3>
            <p class="text-sm text-gray-600 mt-1">
                Hasil normalisasi matrix perbandingan berpasangan
            </p>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @foreach($weights as $criteriaId => $weight)
                @php $criterion = $criteria->firstWhere('id', $criteriaId); @endphp
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-medium text-gray-900">{{ $criterion->name }}</span>
                        <span class="font-bold text-primary-600 text-xl">{{ number_format($weight * 100, 2) }}%</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="flex-1 bg-gray-200 rounded-full h-4">
                            @php
                                $widthPercent = number_format($weight * 100, 1);
                            @endphp
                            <div class="bg-gradient-to-r from-primary-500 to-primary-600 h-4 rounded-full transition-all duration-500" style="width: {{ $widthPercent }}%"></div>
                        </div>
                        <span class="text-sm text-gray-600 w-20">{{ number_format($weight, 4) }}</span>
                    </div>
                    <div class="mt-2 text-xs text-gray-500">
                        @if($weight == max($weights))
                            <i class="fas fa-crown text-yellow-500 mr-1"></i>
                            Prioritas tertinggi
                        @elseif($weight == min($weights))
                            <i class="fas fa-arrow-down text-gray-400 mr-1"></i>
                            Prioritas terendah
                        @else
                            <i class="fas fa-minus text-gray-400 mr-1"></i>
                            Prioritas sedang
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Consistency Analysis -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">
                <i class="fas fa-chart-bar mr-2 text-primary-600"></i>
                Analisis Konsistensi
            </h3>
            <p class="text-sm text-gray-600 mt-1">
                Validasi kualitas perbandingan berpasangan
            </p>
        </div>
        <div class="p-6">
            <!-- Consistency Metrics -->
            <div class="space-y-4">
                <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <i class="fas fa-lambda text-blue-600 mr-2"></i>
                            <span class="text-gray-700 font-medium">λmax (Lambda Max)</span>
                        </div>
                        <span class="font-bold text-blue-900">{{ number_format($lambdaMax, 6) }}</span>
                    </div>
                    <p class="text-xs text-blue-700 mt-2">
                        Nilai eigen maksimum. Semakin dekat dengan {{ count($criteria) }}, semakin konsisten.
                    </p>
                </div>
                
                <div class="bg-yellow-50 rounded-lg p-4 border border-yellow-200">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <i class="fas fa-calculator text-yellow-600 mr-2"></i>
                            <span class="text-gray-700 font-medium">CI (Consistency Index)</span>
                        </div>
                        <span class="font-bold text-yellow-900">{{ number_format($consistencyIndex, 6) }}</span>
                    </div>
                    <p class="text-xs text-yellow-700 mt-2">
                        CI = (λmax - n) / (n - 1) = ({{ number_format($lambdaMax, 4) }} - {{ count($criteria) }}) / {{ count($criteria) - 1 }} = {{ number_format($consistencyIndex, 6) }}
                    </p>
                </div>
                
                <div class="bg-purple-50 rounded-lg p-4 border border-purple-200">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <i class="fas fa-random text-purple-600 mr-2"></i>
                            <span class="text-gray-700 font-medium">RI (Random Index)</span>
                        </div>
                        <span class="font-bold text-purple-900">{{ $randomIndex }}</span>
                    </div>
                    <p class="text-xs text-purple-700 mt-2">
                        Indeks acak untuk matrix {{ count($criteria) }}×{{ count($criteria) }}. Nilai tetap berdasarkan ukuran matrix.
                    </p>
                </div>
                
                <div class="bg-gradient-to-r {{ $consistencyRatio <= 0.1 ? 'from-green-50 to-emerald-50 border-green-200' : 'from-red-50 to-rose-50 border-red-200' }} rounded-lg p-4 border-2">
                    <div class="flex justify-between items-center mb-3">
                        <div class="flex items-center">
                            <i class="fas fa-bullseye {{ $consistencyRatio <= 0.1 ? 'text-green-600' : 'text-red-600' }} mr-2"></i>
                            <span class="text-gray-700 font-bold">CR (Consistency Ratio)</span>
                        </div>
                        <span class="font-bold text-2xl {{ $consistencyRatio <= 0.1 ? 'text-green-700' : 'text-red-700' }}">
                            {{ number_format($consistencyRatio, 6) }}
                        </span>
                    </div>
                    <div class="text-xs {{ $consistencyRatio <= 0.1 ? 'text-green-700' : 'text-red-700' }} mb-2">
                        CR = CI / RI = {{ number_format($consistencyIndex, 6) }} / {{ $randomIndex }} = {{ number_format($consistencyRatio, 6) }}
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex-1 bg-gray-200 rounded-full h-3">
                            <div class="{{ $consistencyRatio <= 0.1 ? 'bg-green-500' : 'bg-red-500' }} h-3 rounded-full" 
                                 style="width: {{ min(100, $consistencyRatio * 1000) }}%"></div>
                        </div>
                        <span class="ml-3 text-sm font-medium {{ $consistencyRatio <= 0.1 ? 'text-green-700' : 'text-red-700' }}">
                            {{ $consistencyRatio <= 0.1 ? 'KONSISTEN' : 'TIDAK KONSISTEN' }}
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Consistency Explanation -->
            <div class="mt-6 p-4 {{ $consistencyRatio <= 0.1 ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200' }} border rounded-lg">
                @if($consistencyRatio <= 0.1)
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-green-600 mr-2 mt-1"></i>
                        <div>
                            <p class="text-green-800 font-semibold mb-2">Perbandingan Konsisten ✓</p>
                            <p class="text-green-700 text-sm mb-2">
                                CR = {{ number_format($consistencyRatio, 4) }} ≤ 0.1, yang berarti perbandingan berpasangan Anda logis dan dapat diandalkan.
                            </p>
                            <ul class="text-green-700 text-xs space-y-1">
                                <li>• Matrix perbandingan memiliki konsistensi yang baik</li>
                                <li>• Bobot prioritas dapat digunakan untuk sistem rekomendasi</li>
                                <li>• Tidak perlu revisi nilai perbandingan</li>
                            </ul>
                        </div>
                    </div>
                @else
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle text-red-600 mr-2 mt-1"></i>
                        <div>
                            <p class="text-red-800 font-semibold mb-2">Perbandingan Tidak Konsisten ⚠️</p>
                            <p class="text-red-700 text-sm mb-2">
                                CR = {{ number_format($consistencyRatio, 4) }} > 0.1, yang berarti ada inkonsistensi dalam perbandingan berpasangan.
                            </p>
                            <ul class="text-red-700 text-xs space-y-1 mb-3">
                                <li>• Tinjau kembali nilai-nilai perbandingan</li>
                                <li>• Pastikan logika perbandingan masuk akal</li>
                                <li>• Contoh: Jika A > B dan B > C, maka A harus > C</li>
                                <li>• Bobot tidak dapat diterapkan sampai konsisten</li>
                            </ul>
                            <div class="text-xs text-red-600 bg-red-100 rounded p-2">
                                <strong>Saran:</strong> Mulai dengan perbandingan yang paling pasti, lalu sesuaikan nilai yang ragu.
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if($consistencyRatio <= 0.1)
<!-- Apply Weights Section -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">
            <i class="fas fa-cogs mr-2 text-primary-600"></i>
            Terapkan Bobot ke Sistem
        </h3>
    </div>
    <div class="p-6">
        <p class="text-gray-700 mb-4">
            Bobot konsisten telah dihitung. Anda dapat menerapkan bobot ini sebagai bobot default untuk sistem rekomendasi villa.
        </p>
        <form action="{{ route('admin.ahp-comparison.apply') }}" method="POST" class="flex justify-end space-x-3">
            @csrf
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition-colors">
                <i class="fas fa-check-double mr-2"></i>
                Terapkan Bobot ke Sistem
            </button>
        </form>
    </div>
</div>
@endif

@endif
@endif

<script>
function updateMatrix(selectElement) {
    const row = selectElement.dataset.row;
    const col = selectElement.dataset.col;
    const value = parseFloat(selectElement.value);
    
    // Add visual feedback for the selected cell
    selectElement.parentElement.classList.add('bg-blue-50', 'border-blue-300');
    setTimeout(() => {
        selectElement.parentElement.classList.remove('bg-blue-50', 'border-blue-300');
    }, 500);
    
    if (value > 0 && !isNaN(value)) {
        // Update reciprocal value with animation
        const reciprocalElement = document.getElementById(`reciprocal-${col}-${row}`);
        const hiddenElement = document.getElementById(`hidden-${col}-${row}`);
        
        if (reciprocalElement && hiddenElement) {
            // Map common fractional values to their integer reciprocals
            const fractionMap = {
                0.111111: 9,  // 1/9 (exact)
                0.11: 9,      // 1/9 (rounded)
                0.125: 8,     // 1/8
                0.142857: 7,  // 1/7 (exact)
                0.14: 7,      // 1/7 (rounded)
                0.166667: 6,  // 1/6 (exact)
                0.17: 6,      // 1/6 (rounded)
                0.2: 5,       // 1/5
                0.25: 4,      // 1/4
                0.333333: 3,  // 1/3 (exact)
                0.333: 3,     // 1/3 (rounded)
                0.33: 3,      // 1/3 (rounded)
                0.5: 2        // 1/2
            };
            
            let reciprocalValue;
            // Check if value matches a known fraction
            let found = false;
            for (const [fraction, reciprocal] of Object.entries(fractionMap)) {
                if (Math.abs(value - parseFloat(fraction)) < 0.01) {
                    reciprocalValue = reciprocal;
                    found = true;
                    break;
                }
            }
            
            // If not found, calculate normally
            if (!found) {
                reciprocalValue = 1 / value;
                // Round to nearest integer if very close
                const rounded = Math.round(reciprocalValue);
                if (Math.abs(reciprocalValue - rounded) < 0.001) {
                    reciprocalValue = rounded;
                }
            }
            
            // Animate the reciprocal update
            reciprocalElement.parentElement.classList.add('bg-green-50', 'border-green-300');
            
            // Display: show integer if whole number, otherwise show 3 decimals
            if (reciprocalValue === Math.floor(reciprocalValue)) {
                reciprocalElement.textContent = reciprocalValue;
            } else {
                reciprocalElement.textContent = reciprocalValue.toFixed(3);
            }
            hiddenElement.value = reciprocalValue.toFixed(6);
            
            setTimeout(() => {
                reciprocalElement.parentElement.classList.remove('bg-green-50', 'border-green-300');
            }, 800);
            
            // Show interpretation tooltip
            showValueInterpretation(selectElement, value, reciprocalValue);
        }
    } else {
        // Clear reciprocal if invalid value
        const reciprocalElement = document.getElementById(`reciprocal-${col}-${row}`);
        const hiddenElement = document.getElementById(`hidden-${col}-${row}`);
        
        if (reciprocalElement && hiddenElement) {
            reciprocalElement.textContent = '-';
            hiddenElement.value = '';
        }
    }
    
    // Update matrix status and check completion
    updateMatrixStatus();
    checkCompletionStatus();
}

function showValueInterpretation(element, value, reciprocal) {
    // Remove existing tooltip
    const existingTooltip = document.querySelector('.value-tooltip');
    if (existingTooltip) {
        existingTooltip.remove();
    }
    
    // Create interpretation text
    let interpretation = '';
    if (value == 1) interpretation = 'Sama penting';
    else if (value == 2) interpretation = 'Sedikit lebih penting';
    else if (value == 3) interpretation = 'Cukup lebih penting';
    else if (value == 4) interpretation = 'Lebih penting';
    else if (value == 5) interpretation = 'Sangat lebih penting';
    else if (value == 6) interpretation = 'Sangat lebih penting+';
    else if (value == 7) interpretation = 'Amat sangat lebih penting';
    else if (value == 8) interpretation = 'Amat sangat lebih penting+';
    else if (value == 9) interpretation = 'Mutlak lebih penting';
    else if (value < 1) interpretation = 'Kurang penting';
    
    // Create tooltip
    const tooltip = document.createElement('div');
    tooltip.className = 'value-tooltip absolute z-10 bg-gray-800 text-white text-xs rounded px-2 py-1 mt-1';
    tooltip.textContent = interpretation + ' (reciprocal: ' + reciprocal.toFixed(3) + ')';
    
    element.parentElement.style.position = 'relative';
    element.parentElement.appendChild(tooltip);
    
    // Remove tooltip after 3 seconds
    setTimeout(() => {
        tooltip.remove();
    }, 3000);
}

function updateMatrixStatus() {
    const inputs = document.querySelectorAll('.comparison-input');
    const totalInputs = inputs.length;
    let filledInputs = 0;
    
    inputs.forEach(input => {
        if (input.value && input.value !== '') {
            filledInputs++;
        }
    });
    
    const progressPercent = totalInputs > 0 ? (filledInputs / totalInputs * 100) : 0;
    const matrixProgress = document.getElementById('matrixProgress');
    const symmetryIndicator = document.getElementById('symmetryIndicator');
    
    if (matrixProgress) {
        if (progressPercent === 0) {
            matrixProgress.textContent = 'Menunggu input perbandingan...';
        } else if (progressPercent < 100) {
            matrixProgress.textContent = `${filledInputs}/${totalInputs} perbandingan terisi (${progressPercent.toFixed(1)}%)`;
        } else {
            matrixProgress.textContent = 'Matrix lengkap! Siap untuk perhitungan.';
        }
    }
    
    if (symmetryIndicator) {
        if (progressPercent === 100) {
            symmetryIndicator.className = 'w-3 h-3 rounded-full bg-green-500';
        } else if (progressPercent > 0) {
            symmetryIndicator.className = 'w-3 h-3 rounded-full bg-yellow-500';
        } else {
            symmetryIndicator.className = 'w-3 h-3 rounded-full bg-gray-300';
        }
    }
}

function checkCompletionStatus() {
    const inputs = document.querySelectorAll('.comparison-input');
    let filledCount = 0;
    let totalCount = 0;
    
    inputs.forEach(input => {
        totalCount++;
        if (input.value && input.value !== '') {
            filledCount++;
        }
    });
    
    // Update UI to show completion status
    const completionRate = totalCount > 0 ? (filledCount / totalCount * 100) : 0;
    
    // Add visual feedback for completion
    if (completionRate === 100) {
        // All filled - show ready for calculation message
        showCalculationReady();
    }
}

function showCalculationReady() {
    // Create or update status message
    let statusDiv = document.getElementById('calculation-status');
    if (!statusDiv) {
        statusDiv = document.createElement('div');
        statusDiv.id = 'calculation-status';
        statusDiv.className = 'mt-4 p-4 bg-green-50 border border-green-200 rounded-lg';
        
        const form = document.getElementById('comparisonForm');
        form.appendChild(statusDiv);
    }
    
    statusDiv.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-600 mr-2"></i>
            <span class="text-green-800 font-medium">
                Semua perbandingan telah terisi! Klik "Simpan & Hitung Bobot" untuk melihat hasil perhitungan.
            </span>
        </div>
    `;
}

function resetComparisons() {
    if (confirm('Yakin ingin mereset semua nilai perbandingan?')) {
        document.querySelectorAll('.comparison-input').forEach(input => {
            input.value = '';
        });
        document.querySelectorAll('.reciprocal-value').forEach(span => {
            span.textContent = '-';
        });
        document.querySelectorAll('input[type="hidden"]').forEach(hidden => {
            if (hidden.name.includes('comparison') && !hidden.name.includes('[1]')) {
                hidden.value = '';
            }
        });
    }
}

function calculateWeights() {
    // Check if all comparisons are filled
    const inputs = document.querySelectorAll('.comparison-input');
    let allFilled = true;
    let emptyCount = 0;
    
    inputs.forEach(input => {
        if (!input.value || input.value === '') {
            allFilled = false;
            emptyCount++;
        }
    });
    
    if (!allFilled) {
        alert(`Harap isi semua nilai perbandingan terlebih dahulu. Masih ada ${emptyCount} perbandingan yang kosong.`);
        return;
    }
    
    // Remove empty hidden inputs before submitting
    document.querySelectorAll('input[type="hidden"]').forEach(hidden => {
        if (hidden.name.includes('comparison') && (!hidden.value || hidden.value === '')) {
            hidden.remove();
        }
    });
    
    // Submit form to calculate
    document.getElementById('comparisonForm').action = '{{ route("admin.ahp-comparison.calculate") }}';
    document.getElementById('comparisonForm').submit();
}

function validateAndSubmit(event) {
    // Check if all comparisons are filled
    const inputs = document.querySelectorAll('.comparison-input');
    let allFilled = true;
    let emptyCount = 0;
    
    inputs.forEach(input => {
        if (!input.value || input.value === '') {
            allFilled = false;
            emptyCount++;
        }
    });
    
    if (!allFilled) {
        event.preventDefault();
        alert(`Harap isi semua nilai perbandingan terlebih dahulu. Masih ada ${emptyCount} perbandingan yang kosong.`);
        return false;
    }
    
    // Remove empty hidden inputs before submitting
    document.querySelectorAll('input[type="hidden"]').forEach(hidden => {
        if (hidden.name.includes('comparison') && (!hidden.value || hidden.value === '')) {
            hidden.remove();
        }
    });
    
    // Set action to calculate (which will save and calculate automatically)
    document.getElementById('comparisonForm').action = '{{ route("admin.ahp-comparison.calculate") }}';
    return true;
}

// Initialize matrix on page load
document.addEventListener('DOMContentLoaded', function() {
    // Initialize matrix with existing values
    document.querySelectorAll('.comparison-input').forEach(input => {
        if (input.value) {
            updateMatrix(input);
        }
    });
    
    // Initialize matrix status
    updateMatrixStatus();
    checkCompletionStatus();
    
    // Add hover effects for better UX
    document.querySelectorAll('.comparison-input').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('ring-2', 'ring-primary-500', 'bg-primary-50');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('ring-2', 'ring-primary-500', 'bg-primary-50');
        });
    });
});
</script>

<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection