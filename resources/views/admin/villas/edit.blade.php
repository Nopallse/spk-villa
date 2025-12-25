@extends('layouts.admin')

@section('page-title', 'Edit Villa')
@section('page-description', 'Perbarui informasi villa')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-6 bg-primary-600 text-white">
            <h3 class="text-xl font-semibold flex items-center">
                <i class="fas fa-edit mr-3"></i>
                Edit Villa: {{ $villa->name }}
            </h3>
            <p class="mt-1 text-primary-100">Perbarui informasi villa sesuai kebutuhan</p>
        </div>
        
        <div class="p-8">
            <form action="{{ route('admin.villas.update', $villa->id) }}" method="POST" enctype="multipart/form-data" id="villaForm">
                @csrf
                @method('PUT')
                
                <!-- Basic Information -->
                <div class="mb-8">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-info-circle mr-2 text-primary-600"></i>
                        Informasi Dasar
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Villa *</label>
                            <input type="text" name="name" value="{{ old('name', $villa->name) }}" 
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('name') border-red-500 @enderror" 
                                   placeholder="Contoh: Villa Sleman Paradise" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Villa *</label>
                            <select name="type" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('type') border-red-500 @enderror" required>
                                <option value="">Pilih Tipe Villa</option>
                                <option value="Modern" {{ old('type', $villa->type) === 'Modern' ? 'selected' : '' }}>Modern</option>
                                <option value="Tradisional" {{ old('type', $villa->type) === 'Tradisional' ? 'selected' : '' }}>Tradisional</option>
                                <option value="Minimalis" {{ old('type', $villa->type) === 'Minimalis' ? 'selected' : '' }}>Minimalis</option>
                                <option value="Resort" {{ old('type', $villa->type) === 'Resort' ? 'selected' : '' }}>Resort</option>
                                <option value="Vila Keluarga" {{ old('type', $villa->type) === 'Vila Keluarga' ? 'selected' : '' }}>Villa Keluarga</option>
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap *</label>
                        <textarea name="address" rows="3" 
                                  class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('address') border-red-500 @enderror" 
                                  placeholder="Masukkan alamat lengkap villa..." required>{{ old('address', $villa->address) }}</textarea>
                        @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Price & Capacity -->
                <div class="mb-8">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-tags mr-2 text-primary-600"></i>
                        Harga & Kapasitas
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Harga Minimum *</label>
                            <input type="number" name="price_min" value="{{ old('price_min', $villa->price_min) }}" 
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('price_min') border-red-500 @enderror" 
                                   placeholder="500000" min="0" required>
                            @error('price_min')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Harga Maximum *</label>
                            <input type="number" name="price_max" value="{{ old('price_max', $villa->price_max) }}" 
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('price_max') border-red-500 @enderror" 
                                   placeholder="750000" min="0" required>
                            @error('price_max')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Luas Area (m²) *</label>
                            <input type="number" name="area" value="{{ old('area', $villa->area) }}" 
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('area') border-red-500 @enderror" 
                                   placeholder="200" min="0" required>
                            @error('area')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kamar Tidur *</label>
                            <input type="number" name="bedrooms" value="{{ old('bedrooms', $villa->bedrooms) }}" 
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('bedrooms') border-red-500 @enderror" 
                                   placeholder="4" min="1" required>
                            @error('bedrooms')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kamar Mandi *</label>
                            <input type="number" name="bathrooms" value="{{ old('bathrooms', $villa->bathrooms) }}" 
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('bathrooms') border-red-500 @enderror" 
                                   placeholder="3" min="1" required>
                            @error('bathrooms')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Garasi</label>
                            <input type="number" name="garage" value="{{ old('garage', $villa->garage) }}" 
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('garage') border-red-500 @enderror" 
                                   placeholder="2" min="0">
                            @error('garage')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Facilities -->
                <div class="mb-8">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-swimming-pool mr-2 text-primary-600"></i>
                        Fasilitas Tambahan
                    </h4>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex items-center">
                            <input type="checkbox" name="swimming_pool" id="swimming_pool" value="1" 
                                   class="rounded border-gray-300 text-primary-600 focus:ring-primary-500" 
                                   {{ old('swimming_pool', $villa->swimming_pool) ? 'checked' : '' }}>
                            <label for="swimming_pool" class="ml-3 text-sm font-medium text-gray-700">
                                <i class="fas fa-swimming-pool mr-2 text-blue-500"></i>
                                Kolam Renang
                            </label>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" name="garden" id="garden" value="1" 
                                   class="rounded border-gray-300 text-primary-600 focus:ring-primary-500" 
                                   {{ old('garden', $villa->garden) ? 'checked' : '' }}>
                            <label for="garden" class="ml-3 text-sm font-medium text-gray-700">
                                <i class="fas fa-leaf mr-2 text-green-500"></i>
                                Taman
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Scoring -->
                <div class="mb-8">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-star mr-2 text-primary-600"></i>
                        Penilaian Kriteria (Skala 1-5)
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Skor Lokasi *</label>
                            <select name="location_score" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('location_score') border-red-500 @enderror" required>
                                <option value="">Pilih Skor</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('location_score', $villa->location_score) == $i ? 'selected' : '' }}>{{ $i }} - {{ $i == 1 ? 'Sangat Buruk' : ($i == 2 ? 'Buruk' : ($i == 3 ? 'Cukup' : ($i == 4 ? 'Baik' : 'Sangat Baik'))) }}</option>
                                @endfor
                            </select>
                            @error('location_score')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Skor Fasilitas *</label>
                            <select name="facilities_score" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('facilities_score') border-red-500 @enderror" required>
                                <option value="">Pilih Skor</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('facilities_score', $villa->facilities_score) == $i ? 'selected' : '' }}>{{ $i }} - {{ $i == 1 ? 'Sangat Buruk' : ($i == 2 ? 'Buruk' : ($i == 3 ? 'Cukup' : ($i == 4 ? 'Baik' : 'Sangat Baik'))) }}</option>
                                @endfor
                            </select>
                            @error('facilities_score')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Skor Aksesibilitas *</label>
                            <select name="accessibility_score" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('accessibility_score') border-red-500 @enderror" required>
                                <option value="">Pilih Skor</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('accessibility_score', $villa->accessibility_score) == $i ? 'selected' : '' }}>{{ $i }} - {{ $i == 1 ? 'Sangat Buruk' : ($i == 2 ? 'Buruk' : ($i == 3 ? 'Cukup' : ($i == 4 ? 'Baik' : 'Sangat Baik'))) }}</option>
                                @endfor
                            </select>
                            @error('accessibility_score')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Skor Keamanan *</label>
                            <select name="security_score" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('security_score') border-red-500 @enderror" required>
                                <option value="">Pilih Skor</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('security_score', $villa->security_score) == $i ? 'selected' : '' }}>{{ $i }} - {{ $i == 1 ? 'Sangat Buruk' : ($i == 2 ? 'Buruk' : ($i == 3 ? 'Cukup' : ($i == 4 ? 'Baik' : 'Sangat Baik'))) }}</option>
                                @endfor
                            </select>
                            @error('security_score')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Skor Lingkungan *</label>
                            <select name="environment_score" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('environment_score') border-red-500 @enderror" required>
                                <option value="">Pilih Skor</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('environment_score', $villa->environment_score) == $i ? 'selected' : '' }}>{{ $i }} - {{ $i == 1 ? 'Sangat Buruk' : ($i == 2 ? 'Buruk' : ($i == 3 ? 'Cukup' : ($i == 4 ? 'Baik' : 'Sangat Baik'))) }}</option>
                                @endfor
                            </select>
                            @error('environment_score')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <div class="flex items-center h-full">
                                <input type="checkbox" name="is_active" id="is_active" value="1" 
                                       class="rounded border-gray-300 text-primary-600 focus:ring-primary-500" 
                                       {{ old('is_active', $villa->is_active) ? 'checked' : '' }}>
                                <label for="is_active" class="ml-3 text-sm font-medium text-gray-700">
                                    <i class="fas fa-toggle-on mr-2 text-green-500"></i>
                                    Villa Aktif
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description & Image -->
                <div class="mb-8">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-image mr-2 text-primary-600"></i>
                        Deskripsi & Foto
                    </h4>
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Villa</label>
                            <textarea name="description" rows="4" 
                                      class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('description') border-red-500 @enderror" 
                                      placeholder="Deskripsikan villa dengan detail untuk menarik tamu...">{{ old('description', $villa->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Villa</label>
                            
                            @if($villa->image)
                                <div class="mb-4">
                                    <p class="text-sm text-gray-600 mb-2">Foto Saat Ini:</p>
                                    <img src="{{ asset('storage/' . $villa->image) }}" alt="{{ $villa->name }}" 
                                         class="w-32 h-24 object-cover rounded-lg border border-gray-300">
                                </div>
                            @endif
                            
                            <input type="file" name="image" accept="image/*" 
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('image') border-red-500 @enderror">
                            <p class="mt-1 text-sm text-gray-500">
                                Format yang didukung: JPG, JPEG, PNG, GIF. Maksimal 2MB.
                                @if($villa->image)
                                    <br>Kosongkan jika tidak ingin mengganti foto.
                                @endif
                            </p>
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.villas.index') }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                    <button type="submit" class="px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                        <i class="fas fa-save mr-2"></i>Update Villa
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const priceMinInput = document.querySelector('input[name="price_min"]');
    const priceMaxInput = document.querySelector('input[name="price_max"]');
    
    // Validate price range
    function validatePrices() {
        const priceMin = parseFloat(priceMinInput.value) || 0;
        const priceMax = parseFloat(priceMaxInput.value) || 0;
        
        if (priceMax > 0 && priceMin > priceMax) {
            priceMaxInput.setCustomValidity('Harga maksimum harus lebih besar atau sama dengan harga minimum');
        } else {
            priceMaxInput.setCustomValidity('');
        }
    }
    
    priceMinInput.addEventListener('input', validatePrices);
    priceMaxInput.addEventListener('input', validatePrices);
    
    // Form submission
    document.getElementById('villaForm').addEventListener('submit', function(e) {
        validatePrices();
    });
});
</script>
@endpush
@endsection