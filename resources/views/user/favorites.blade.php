<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                    Favorit Saya
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Daftar villa yang telah Anda simpan sebagai favorit
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @php
                // In real app, this would come from database
                $favorites = []; // Will be populated from user_favorites table
            @endphp

            @if(count($favorites) > 0)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-900">
                        <i class="fas fa-heart text-red-600 mr-2"></i>
                        Villa Favorit ({{ count($favorites) }})
                    </h3>
                    <button class="text-red-600 hover:text-red-700 text-sm font-medium">
                        <i class="fas fa-trash mr-1"></i>Hapus Semua
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($favorites as $villa)
                    <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition">
                        <div class="h-48 bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center relative">
                            <i class="fas fa-home text-primary-400 text-5xl"></i>
                            <button class="absolute top-2 right-2 bg-white p-2 rounded-full hover:bg-red-50 transition">
                                <i class="fas fa-heart text-red-500"></i>
                            </button>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-gray-900 mb-1">{{ $villa->name }}</h4>
                            <p class="text-sm text-gray-600 mb-2">
                                <i class="fas fa-map-marker-alt text-gray-400 mr-1"></i>
                                {{ Str::limit($villa->address, 40) }}
                            </p>
                            <div class="flex items-center mb-3">
                                <div class="flex text-yellow-400 mr-2">
                                    @for($i = 0; $i < 5; $i++)
                                    <i class="fas fa-star text-xs"></i>
                                    @endfor
                                </div>
                                <span class="text-xs text-gray-500">(4.5+)</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-primary-600">Rp {{ number_format($villa->price_per_night ?? 0, 0, ',', '.') }}</span>
                                <a href="{{ route('villa.detail', $villa->id) }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium">
                                    Detail <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <div class="max-w-md mx-auto">
                    <i class="fas fa-heart text-gray-300 text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Favorit</h3>
                    <p class="text-gray-600 mb-6">
                        Anda belum menyimpan villa sebagai favorit. Mulai jelajahi villa dan simpan yang Anda sukai!
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="{{ route('user.villas.index') }}" class="bg-primary-600 text-white px-6 py-2 rounded-lg hover:bg-primary-700 transition">
                            <i class="fas fa-search mr-2"></i>Cari Villa
                        </a>
                        <a href="{{ route('user.recommendations.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
                            <i class="fas fa-star mr-2"></i>Lihat Rekomendasi
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex justify-between items-center bg-white rounded-xl shadow-lg p-6 mt-8">
                <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

