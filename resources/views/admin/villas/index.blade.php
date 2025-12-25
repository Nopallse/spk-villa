@extends('layouts.admin')

@section('page-title', 'Manajemen Villa')
@section('page-description', 'Kelola data villa dan informasi lengkapnya untuk sistem rekomendasi')

@section('content')
<div class="mb-8">
    <!-- Filter & Search -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <form method="GET" action="{{ route('admin.villas.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari Villa</label>
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama villa atau lokasi..." 
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Rentang Harga</label>
                    <select name="price_range" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <option value="">Semua Harga</option>
                        <option value="low" {{ request('price_range') === 'low' ? 'selected' : '' }}>< Rp 500K</option>
                        <option value="medium" {{ request('price_range') === 'medium' ? 'selected' : '' }}>Rp 500K - 1M</option>
                        <option value="high" {{ request('price_range') === 'high' ? 'selected' : '' }}>> Rp 1M</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <option value="">Semua Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kapasitas</label>
                    <select name="capacity" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <option value="">Semua Kapasitas</option>
                        <option value="small" {{ request('capacity') === 'small' ? 'selected' : '' }}>1-2 Kamar</option>
                        <option value="medium" {{ request('capacity') === 'medium' ? 'selected' : '' }}>3-4 Kamar</option>
                        <option value="large" {{ request('capacity') === 'large' ? 'selected' : '' }}>5+ Kamar</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-between items-center mt-4">
                <div class="flex space-x-2">
                    <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition">
                        <i class="fas fa-filter mr-2"></i>Filter
                    </button>
                    <a href="{{ route('admin.villas.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                        <i class="fas fa-refresh mr-2"></i>Reset
                    </a>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.villas.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                        <i class="fas fa-plus mr-2"></i>Tambah Villa
                    </a>
                    <a href="{{ route('admin.villas.export') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-download mr-2"></i>Export CSV
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Results Summary -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Hasil Filter</h3>
                <p class="text-sm text-gray-600">
                    Menampilkan {{ $villas->count() }} dari {{ $totalVillas }} total villa
                </p>
            </div>
            @if($villas->count() > 0)
            <button onclick="toggleBulkActions()" id="bulkActionBtn" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition" style="display: none;">
                <i class="fas fa-trash mr-2"></i>Hapus Terpilih
            </button>
            @endif
        </div>
    </div>

    <!-- Villa Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        @if($villas->count() > 0)
        <form id="bulkForm" action="{{ route('admin.villas.bulk-delete') }}" method="POST">
            @csrf
            @method('DELETE')
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Villa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kapasitas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Skor Rata-rata</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($villas as $villa)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" name="villa_ids[]" value="{{ $villa->id }}" class="villa-checkbox rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($villa->image)
                                        <img src="{{ asset('storage/' . $villa->image) }}" 
                                             alt="{{ $villa->name }}" 
                                             class="w-12 h-12 rounded-lg object-cover">
                                    @else
                                        <div class="w-12 h-12 rounded-lg bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-home text-gray-400"></i>
                                        </div>
                                    @endif
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $villa->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $villa->type }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ Str::limit($villa->address, 30) }}</div>
                                <div class="text-sm text-gray-500">{{ $villa->area }} m²</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-primary-600">
                                    Rp {{ number_format($villa->price_min) }}
                                    @if($villa->price_max != $villa->price_min)
                                        - Rp {{ number_format($villa->price_max) }}
                                    @endif
                                </div>
                                <div class="text-sm text-gray-500">/malam</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $villa->bedrooms }} Kamar</div>
                                <div class="text-sm text-gray-500">{{ $villa->bathrooms }} KM</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $avgScore = ($villa->location_score + $villa->facilities_score + $villa->accessibility_score + $villa->security_score + $villa->environment_score) / 5;
                                @endphp
                                <div class="flex items-center">
                                    <div class="flex text-yellow-400">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= floor($avgScore))
                                                <i class="fas fa-star text-xs"></i>
                                            @elseif($i <= ceil($avgScore))
                                                <i class="fas fa-star-half-alt text-xs"></i>
                                            @else
                                                <i class="far fa-star text-xs"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="ml-1 text-sm text-gray-600">({{ number_format($avgScore, 1) }})</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $villa->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $villa->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.villas.show', $villa) }}" class="text-blue-600 hover:text-blue-900" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.villas.edit', $villa) }}" class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.villas.toggle-status', $villa) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-{{ $villa->is_active ? 'orange' : 'green' }}-600 hover:text-{{ $villa->is_active ? 'orange' : 'green' }}-900" 
                                                title="{{ $villa->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                            <i class="fas fa-{{ $villa->is_active ? 'toggle-off' : 'toggle-on' }}"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.villas.destroy', $villa) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Yakin ingin menghapus villa {{ $villa->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>

        <!-- Pagination -->
        <div class="bg-white px-6 py-3 flex items-center justify-between border-t border-gray-200">
            {{ $villas->links() }}
        </div>
        @else
        <div class="p-6 text-center">
            <div class="text-gray-400 mb-4">
                <i class="fas fa-home text-6xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada villa ditemukan</h3>
            <p class="text-gray-600 mb-4">Belum ada villa yang sesuai dengan kriteria pencarian Anda.</p>
            <a href="{{ route('admin.villas.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition">
                <i class="fas fa-plus mr-2"></i>Tambah Villa Pertama
            </a>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('selectAll');
    const villaCheckboxes = document.querySelectorAll('.villa-checkbox');
    const bulkActionBtn = document.getElementById('bulkActionBtn');
    const bulkForm = document.getElementById('bulkForm');

    // Select all functionality
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            villaCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            toggleBulkActions();
        });
    }

    // Individual checkbox change
    villaCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const checkedBoxes = document.querySelectorAll('.villa-checkbox:checked');
            if (selectAllCheckbox) {
                selectAllCheckbox.checked = checkedBoxes.length === villaCheckboxes.length;
            }
            toggleBulkActions();
        });
    });

    // Toggle bulk actions visibility
    function toggleBulkActions() {
        const checkedBoxes = document.querySelectorAll('.villa-checkbox:checked');
        if (bulkActionBtn) {
            bulkActionBtn.style.display = checkedBoxes.length > 0 ? 'block' : 'none';
        }
    }

    // Bulk delete
    if (bulkActionBtn) {
        bulkActionBtn.addEventListener('click', function() {
            const checkedBoxes = document.querySelectorAll('.villa-checkbox:checked');
            if (checkedBoxes.length === 0) {
                alert('Pilih minimal satu villa untuk dihapus.');
                return;
            }
            
            if (confirm(`Yakin ingin menghapus ${checkedBoxes.length} villa yang dipilih?`)) {
                bulkForm.submit();
            }
        });
    }
});
</script>
@endpush
@endsection