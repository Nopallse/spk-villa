@extends('layouts.admin')

@section('page-title', 'Detail Villa')
@section('page-description', 'Informasi lengkap villa')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header Actions -->
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $villa->name }}</h1>
            <p class="text-gray-600 mt-1">{{ $villa->type }} • {{ $villa->address }}</p>
        </div>
        
        <div class="flex space-x-3">
            <a href="{{ route('admin.villas.edit', $villa->id) }}" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                <i class="fas fa-edit mr-2"></i>Edit Villa
            </a>
            <a href="{{ route('admin.villas.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Villa Image -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                @if($villa->image)
                    <img src="{{ asset('storage/' . $villa->image) }}" alt="{{ $villa->name }}" 
                         class="w-full h-64 lg:h-80 object-cover">
                @else
                    <div class="w-full h-64 lg:h-80 bg-gray-200 flex items-center justify-center">
                        <div class="text-center">
                            <i class="fas fa-image text-4xl text-gray-400 mb-2"></i>
                            <p class="text-gray-500">Tidak ada foto</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Description -->
            @if($villa->description)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-align-left mr-2 text-primary-600"></i>
                    Deskripsi
                </h3>
                <p class="text-gray-700 leading-relaxed">{{ $villa->description }}</p>
            </div>
            @endif

            <!-- Pricing Information -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-tag mr-2 text-primary-600"></i>
                    Informasi Harga
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="text-green-800">
                            <p class="text-sm font-medium">Harga Minimum</p>
                            <p class="text-2xl font-bold">Rp {{ number_format($villa->price_min, 0, ',', '.') }}</p>
                            <p class="text-sm">per malam</p>
                        </div>
                    </div>
                    
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="text-blue-800">
                            <p class="text-sm font-medium">Harga Maksimum</p>
                            <p class="text-2xl font-bold">Rp {{ number_format($villa->price_max, 0, ',', '.') }}</p>
                            <p class="text-sm">per malam</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 text-center">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $villa->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        <i class="fas fa-{{ $villa->is_active ? 'check-circle' : 'times-circle' }} mr-1"></i>
                        {{ $villa->is_active ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </div>
            </div>

            <!-- Specifications -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-home mr-2 text-primary-600"></i>
                    Spesifikasi Villa
                </h3>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <i class="fas fa-expand-arrows-alt text-2xl text-primary-600 mb-2"></i>
                        <p class="text-sm text-gray-600">Luas Area</p>
                        <p class="text-lg font-semibold">{{ $villa->area }} m²</p>
                    </div>
                    
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <i class="fas fa-bed text-2xl text-primary-600 mb-2"></i>
                        <p class="text-sm text-gray-600">Kamar Tidur</p>
                        <p class="text-lg font-semibold">{{ $villa->bedrooms }}</p>
                    </div>
                    
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <i class="fas fa-bath text-2xl text-primary-600 mb-2"></i>
                        <p class="text-sm text-gray-600">Kamar Mandi</p>
                        <p class="text-lg font-semibold">{{ $villa->bathrooms }}</p>
                    </div>
                    
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <i class="fas fa-car text-2xl text-primary-600 mb-2"></i>
                        <p class="text-sm text-gray-600">Garasi</p>
                        <p class="text-lg font-semibold">{{ $villa->garage ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Facilities -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-swimming-pool mr-2 text-primary-600"></i>
                    Fasilitas
                </h3>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center p-3 rounded-lg {{ $villa->swimming_pool ? 'bg-green-50 text-green-700' : 'bg-gray-50 text-gray-500' }}">
                        <i class="fas fa-swimming-pool mr-3 text-lg"></i>
                        <span class="font-medium">Kolam Renang</span>
                        <i class="fas fa-{{ $villa->swimming_pool ? 'check' : 'times' }} ml-auto"></i>
                    </div>
                    
                    <div class="flex items-center p-3 rounded-lg {{ $villa->garden ? 'bg-green-50 text-green-700' : 'bg-gray-50 text-gray-500' }}">
                        <i class="fas fa-leaf mr-3 text-lg"></i>
                        <span class="font-medium">Taman</span>
                        <i class="fas fa-{{ $villa->garden ? 'check' : 'times' }} ml-auto"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Info -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-primary-600"></i>
                    Info Singkat
                </h3>
                
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tipe</span>
                        <span class="font-medium">{{ $villa->type }}</span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status</span>
                        <span class="font-medium {{ $villa->is_active ? 'text-green-600' : 'text-red-600' }}">
                            {{ $villa->is_active ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-gray-600">Kapasitas</span>
                        <span class="font-medium">{{ $villa->bedrooms * 2 }} Orang</span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-gray-600">Dibuat</span>
                        <span class="font-medium">{{ $villa->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Scoring -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-star mr-2 text-primary-600"></i>
                    Penilaian Kriteria
                </h3>
                
                <div class="space-y-4">
                    @php
                        $criteriaScores = [
                            'Lokasi' => $villa->location_score,
                            'Fasilitas' => $villa->facilities_score,
                            'Aksesibilitas' => $villa->accessibility_score,
                            'Keamanan' => $villa->security_score,
                            'Lingkungan' => $villa->environment_score
                        ];
                    @endphp
                    
                    @foreach($criteriaScores as $criteria => $score)
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700">{{ $criteria }}</span>
                            <span class="text-sm text-gray-500">{{ $score }}/5</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="h-2 rounded-full transition-all duration-300 {{ $score >= 4 ? 'bg-green-500' : ($score >= 3 ? 'bg-yellow-500' : 'bg-red-500') }}" 
                                 style="width: {{ ($score / 5) * 100 }}%"></div>
                        </div>
                        <div class="flex justify-end mt-1">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star text-xs {{ $i <= $score ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                            @endfor
                        </div>
                    </div>
                    @endforeach
                    
                    @php
                        $averageScore = array_sum($criteriaScores) / count($criteriaScores);
                    @endphp
                    
                    <div class="pt-3 border-t border-gray-200">
                        <div class="text-center">
                            <p class="text-sm text-gray-600">Rata-rata Skor</p>
                            <p class="text-2xl font-bold {{ $averageScore >= 4 ? 'text-green-600' : ($averageScore >= 3 ? 'text-yellow-600' : 'text-red-600') }}">
                                {{ number_format($averageScore, 1) }}/5
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-cogs mr-2 text-primary-600"></i>
                    Aksi
                </h3>
                
                <div class="space-y-3">
                    <a href="{{ route('admin.villas.edit', $villa->id) }}" 
                       class="w-full flex items-center justify-center px-4 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Villa
                    </a>
                    
                    <form action="{{ route('admin.villas.toggle-status', $villa->id) }}" method="POST" class="w-full">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="w-full flex items-center justify-center px-4 py-3 {{ $villa->is_active ? 'bg-yellow-600 hover:bg-yellow-700' : 'bg-green-600 hover:bg-green-700' }} text-white rounded-lg transition">
                            <i class="fas fa-{{ $villa->is_active ? 'pause' : 'play' }} mr-2"></i>
                            {{ $villa->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                        </button>
                    </form>
                    
                    <form action="{{ route('admin.villas.destroy', $villa->id) }}" method="POST" 
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus villa ini? Aksi ini tidak dapat dibatalkan.')" 
                          class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full flex items-center justify-center px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            <i class="fas fa-trash mr-2"></i>
                            Hapus Villa
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add any additional JavaScript for the detail page if needed
    console.log('Villa detail page loaded');
});
</script>
@endpush
@endsection