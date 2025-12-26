@extends('layouts.admin')

@section('page-title', 'Manajemen Kriteria')
@section('page-description', 'Kelola kriteria penilaian villa untuk sistem rekomendasi')

@section('content')
<!-- Alert Messages -->
@if(session('success'))
<div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6">
    <div class="flex">
        <div class="flex-shrink-0">
            <i class="fas fa-check-circle text-green-400"></i>
        </div>
        <div class="ml-3">
            <p class="text-sm text-green-700">{{ session('success') }}</p>
        </div>
    </div>
</div>
@endif

@if(session('error'))
<div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
    <div class="flex">
        <div class="flex-shrink-0">
            <i class="fas fa-exclamation-circle text-red-400"></i>
        </div>
        <div class="ml-3">
            <p class="text-sm text-red-700">{{ session('error') }}</p>
        </div>
    </div>
</div>
@endif

<!-- Stats Cards -->
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
                <p class="text-2xl font-bold text-gray-900">{{ $criteria->total() }}</p>
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
                <p class="text-sm font-medium text-gray-500">Kriteria Aktif</p>
                <p class="text-2xl font-bold text-gray-900">{{ $criteria->where('is_active', true)->count() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-600">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-thumbs-up text-blue-600 text-xl"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Benefit Type</p>
                <p class="text-2xl font-bold text-gray-900">{{ $criteria->where('type', 'benefit')->count() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-orange-600">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="bg-orange-100 p-3 rounded-full">
                    <i class="fas fa-dollar-sign text-orange-600 text-xl"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Cost Type</p>
                <p class="text-2xl font-bold text-gray-900">{{ $criteria->where('type', 'cost')->count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- AHP Phase 1 Info -->
<div class="bg-blue-50 border-l-4 border-blue-400 p-6 mb-8">
    <div class="flex">
        <div class="flex-shrink-0">
            <i class="fas fa-info-circle text-blue-400 text-xl"></i>
        </div>
        <div class="ml-3">
            <h3 class="text-lg font-medium text-blue-800">📋 Tahap 1: Menentukan Daftar Kriteria</h3>
            <div class="mt-2 text-sm text-blue-700">
                <p class="mb-2">Anda sedang berada pada tahap pertama proses AHP. Pada tahap ini, tentukan kriteria apa saja yang akan digunakan untuk menilai villa:</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                    <div>
                        <p class="font-medium">✅ Contoh Kriteria Benefit (semakin tinggi semakin baik):</p>
                        <ul class="list-disc list-inside ml-2 space-y-1 text-xs">
                            <li>Lokasi strategis</li>
                            <li>Fasilitas lengkap</li>
                            <li>Kebersihan villa</li>
                            <li>Rating dari tamu</li>
                            <li>Kapasitas tamu</li>
                        </ul>
                    </div>
                    <div>
                        <p class="font-medium">💰 Contoh Kriteria Cost (semakin rendah semakin baik):</p>
                        <ul class="list-disc list-inside ml-2 space-y-1 text-xs">
                            <li>Harga sewa per malam</li>
                            <li>Biaya tambahan</li>
                            <li>Deposit yang diperlukan</li>
                        </ul>
                    </div>
                </div>
                <div class="mt-3 p-3 bg-white rounded border border-blue-200">
                    <p class="text-xs"><strong>🔄 Tahap Selanjutnya:</strong> 
                    @if(count($criteria) >= 2)
                        Kriteria sudah cukup! Lanjut ke menu 
                        <a href="{{ route('admin.ahp-comparison.index') }}" class="font-medium underline hover:text-blue-800">"AHP Comparison"</a> 
                        untuk menentukan bobot prioritas.
                    @else
                        Tambah minimal 2 kriteria terlebih dahulu, kemudian lanjut ke "AHP Comparison" untuk menentukan bobot prioritas.
                    @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Action Bar -->
<div class="bg-white rounded-xl shadow-lg p-6 mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">
                <i class="fas fa-cogs mr-2 text-primary-600"></i>
                Kriteria Penilaian
            </h3>
            <p class="text-sm text-gray-600 mt-1">
                Kriteria yang digunakan untuk mengevaluasi villa dalam sistem AHP
            </p>
        </div>
        <div class="flex items-center space-x-3">
            <button onclick="openCreateModal()" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Tambah Kriteria
            </button>
        </div>
    </div>
</div>

<!-- Criteria Table -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">
                <i class="fas fa-table mr-2 text-primary-600"></i>
                Daftar Kriteria
            </h3>
            <div class="flex items-center space-x-3">
                <span class="text-sm text-gray-500">Total: {{ $criteria->total() }} kriteria</span>
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Cari kriteria..." 
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200" id="criteriaTable">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">
                        Urutan
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Kriteria
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tipe
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Code
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody id="criteriaTableBody" class="bg-white divide-y divide-gray-200">
                @forelse($criteria as $criterion)
                <tr class="hover:bg-gray-50 criteria-row" data-id="{{ $criterion->id }}" data-order="{{ $criterion->order }}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center justify-center">
                            <div class="bg-primary-600 text-white w-8 h-8 rounded-full flex items-center justify-center font-semibold">
                                {{ $criterion->order }}
                            </div>
                            <div class="drag-handle cursor-grab active:cursor-grabbing ml-3 p-2 hover:bg-gray-100 rounded" title="Drag untuk mengurutkan">
                                <i class="fas fa-grip-vertical text-gray-500 text-lg"></i>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="bg-primary-100 w-10 h-10 rounded-full flex items-center justify-center">
                                @if($criterion->type == 'cost')
                                    <i class="fas fa-dollar-sign text-orange-600"></i>
                                @else
                                    <i class="fas fa-thumbs-up text-green-600"></i>
                                @endif
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900 criteria-name">{{ $criterion->name }}</div>
                                <div class="text-sm text-gray-500 criteria-description">{{ $criterion->description ?? 'Tidak ada deskripsi' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($criterion->type == 'cost')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                                <i class="fas fa-arrow-down mr-1"></i>
                                Cost (Semakin Rendah Semakin Baik)
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i class="fas fa-arrow-up mr-1"></i>
                                Benefit (Semakin Tinggi Semakin Baik)
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            <i class="fas fa-code mr-1"></i>
                            {{ $criterion->code }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($criterion->is_active)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                <i class="fas fa-pause-circle mr-1"></i>
                                Nonaktif
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-2">
                            <button onclick="editCriterion({{ $criterion->id }})" class="text-primary-600 hover:text-primary-700 bg-primary-50 hover:bg-primary-100 px-3 py-1 rounded-md transition-colors">
                                <i class="fas fa-edit mr-1"></i>
                                Edit
                            </button>
                            <button onclick="toggleStatus({{ $criterion->id }})" class="text-yellow-600 hover:text-yellow-700 bg-yellow-50 hover:bg-yellow-100 px-3 py-1 rounded-md transition-colors">
                                <i class="fas fa-toggle-{{ $criterion->is_active ? 'on' : 'off' }} mr-1"></i>
                                {{ $criterion->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                            <form action="{{ route('admin.criteria.delete', $criterion->id) }}" method="POST" class="inline-block" 
                                  onsubmit="return confirm('Yakin ingin menghapus kriteria {{ $criterion->name }}? Tindakan ini tidak dapat dibatalkan.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 px-3 py-1 rounded-md transition-colors">
                                    <i class="fas fa-trash mr-1"></i>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr id="emptyState">
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-list text-4xl text-gray-300 mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada kriteria</h3>
                            <p class="text-gray-500 mb-4">Tambah kriteria pertama untuk memulai sistem penilaian.</p>
                            <button onclick="openCreateModal()" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg transition-colors">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Kriteria
                            </button>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($criteria->hasPages())
    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
        {{ $criteria->links() }}
    </div>
    @endif
</div>

<!-- Create/Edit Criterion Modal -->
<div id="criterionModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-md sm:w-full">
            <div class="bg-white px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 id="modalTitle" class="text-lg font-medium text-gray-900">Tambah Kriteria</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <form id="criterionForm" action="{{ route('admin.criteria.store') }}" method="POST">
                @csrf
                <div id="methodField"></div>
                <div class="px-6 py-4 space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Kriteria <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" required placeholder="contoh: Harga, Lokasi, Fasilitas"
                               class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <p class="text-xs text-gray-500 mt-1">Nama kriteria yang akan digunakan untuk evaluasi villa</p>
                    </div>
                    
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Tipe Kriteria <span class="text-red-500">*</span></label>
                        <select id="type" name="type" required
                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            <option value="">Pilih Tipe</option>
                            <option value="benefit">Benefit - Semakin tinggi semakin baik</option>
                            <option value="cost">Cost - Semakin rendah semakin baik</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">
                            <strong>Benefit:</strong> Rating, Fasilitas, Kebersihan (semakin tinggi semakin baik)<br>
                            <strong>Cost:</strong> Harga (semakin rendah semakin baik)
                        </p>
                    </div>
                    
                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700">Kode Kriteria</label>
                        <input type="text" id="code" name="code" maxlength="10" placeholder="Otomatis jika kosong"
                               class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <p class="text-xs text-gray-500 mt-1">Kode singkat untuk kriteria (3-10 karakter)</p>
                    </div>
                    
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea id="description" name="description" rows="3" placeholder="Penjelasan detail tentang kriteria ini"
                                  class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500"></textarea>
                    </div>
                    
                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700">Urutan Tampilan <span class="text-red-500">*</span></label>
                        <input type="number" id="order" name="order" min="1" required value="1"
                               class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <p class="text-xs text-gray-500 mt-1">Urutan kriteria dalam daftar (1, 2, 3, ...)</p>
                    </div>
                    
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" id="is_active" name="is_active" value="1" checked
                                   class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                            <span class="ml-2 text-sm text-gray-700">Aktifkan kriteria ini</span>
                        </label>
                        <p class="text-xs text-gray-500 mt-1">Hanya kriteria aktif yang akan digunakan dalam analisis AHP</p>
                    </div>
                    
                    <!-- Info Box -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                        <div class="flex">
                            <i class="fas fa-info-circle text-blue-400 mt-0.5 mr-2"></i>
                            <div class="text-xs text-blue-700">
                                <p><strong>Catatan:</strong> Pada tahap ini Anda hanya menentukan daftar kriteria yang akan digunakan. 
                                Bobot prioritas akan ditentukan nanti melalui proses AHP (Analytic Hierarchy Process) dengan perbandingan berpasangan.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-md">
                        <i class="fas fa-save mr-2"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let editingId = null;
let sortableInstance = null;

// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('.criteria-row');
    let visibleRows = 0;
    
    rows.forEach(row => {
        const name = row.querySelector('.criteria-name').textContent.toLowerCase();
        const description = row.querySelector('.criteria-description').textContent.toLowerCase();
        
        if (name.includes(searchTerm) || description.includes(searchTerm)) {
            row.style.display = '';
            visibleRows++;
        } else {
            row.style.display = 'none';
        }
    });
    
    // Show empty state if no results
    const emptyState = document.getElementById('emptyState');
    if (emptyState) {
        emptyState.style.display = visibleRows === 0 ? '' : 'none';
    }
});

// Initialize SortableJS when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    const tbody = document.getElementById('criteriaTableBody');
    if (tbody) {
        sortableInstance = new Sortable(tbody, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-drag',
            dragClass: 'sortable-drag',
            forceFallback: false,
            fallbackOnBody: true,
            swapThreshold: 0.65,
            onEnd: function(evt) {
                updateOrder();
            }
        });
    }
});

// Modal functions
function openCreateModal() {
    editingId = null;
    document.getElementById('modalTitle').textContent = 'Tambah Kriteria';
    document.getElementById('criterionForm').action = '{{ route("admin.criteria.store") }}';
    document.getElementById('methodField').innerHTML = '';
    
    // Reset form fields
    document.getElementById('criterionForm').reset();
    document.getElementById('name').value = '';
    document.getElementById('code').value = '';
    document.getElementById('type').value = '';
    document.getElementById('description').value = '';
    document.getElementById('order').value = '1';
    document.getElementById('is_active').checked = true;
    
    document.getElementById('criterionModal').classList.remove('hidden');
}

function editCriterion(id) {
    editingId = id;
    document.getElementById('modalTitle').textContent = 'Edit Kriteria';
    document.getElementById('criterionForm').action = `/admin/criteria/${id}`;
    document.getElementById('methodField').innerHTML = '@method("PUT")';
    
    // Show loading state
    const submitBtn = document.querySelector('#criterionForm button[type="submit"]');
    const originalBtnText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memuat...';
    
    // Fetch criterion data via AJAX
    fetch(`/admin/criteria/${id}`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success && data.data) {
            const criterion = data.data;
            
            // Populate form fields
            document.getElementById('name').value = criterion.name || '';
            document.getElementById('code').value = criterion.code || '';
            document.getElementById('type').value = criterion.type || 'benefit';
            document.getElementById('description').value = criterion.description || '';
            document.getElementById('order').value = criterion.order || 1;
            
            // Handle is_active checkbox
            const isActiveCheckbox = document.getElementById('is_active');
            if (isActiveCheckbox) {
                isActiveCheckbox.checked = criterion.is_active == 1 || criterion.is_active === true || criterion.is_active === '1';
            }
            
            // Show modal
            document.getElementById('criterionModal').classList.remove('hidden');
        } else {
            showToast('Gagal memuat data kriteria', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Terjadi kesalahan saat memuat data kriteria', 'error');
    })
    .finally(() => {
        // Restore button state
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnText;
    });
}

function toggleStatus(id) {
    if (confirm('Yakin ingin mengubah status kriteria ini?')) {
        // In real implementation, send AJAX request
        fetch(`/admin/criteria/${id}/toggle`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }
}

function closeModal() {
    document.getElementById('criterionModal').classList.add('hidden');
    editingId = null;
    
    // Reset form when closing
    document.getElementById('criterionForm').reset();
    document.getElementById('name').value = '';
    document.getElementById('code').value = '';
    document.getElementById('type').value = '';
    document.getElementById('description').value = '';
    document.getElementById('order').value = '1';
    document.getElementById('is_active').checked = true;
}

// Close modal on outside click
document.getElementById('criterionModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

// Update order after drag
function updateOrder() {
    const rows = document.querySelectorAll('#criteriaTableBody tr[data-id]');
    const items = [];
    
    rows.forEach((row, index) => {
        items.push({
            id: parseInt(row.getAttribute('data-id')),
            order: index + 1
        });
    });
    
    // Show loading indicator
    const loadingToast = showToast('Memperbarui urutan...', 'info');
    
    fetch('{{ route("admin.criteria.update-order") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ items: items })
    })
    .then(response => response.json())
    .then(data => {
        hideToast(loadingToast);
        if (data.success) {
            // Update order numbers in UI
            rows.forEach((row, index) => {
                const orderBadge = row.querySelector('.bg-primary-600');
                if (orderBadge) {
                    orderBadge.textContent = index + 1;
                    row.setAttribute('data-order', index + 1);
                }
            });
            showToast(data.message || 'Urutan berhasil diperbarui', 'success');
        } else {
            showToast(data.message || 'Gagal memperbarui urutan', 'error');
            location.reload(); // Reload to sync with server
        }
    })
    .catch(error => {
        hideToast(loadingToast);
        console.error('Error:', error);
        showToast('Terjadi kesalahan saat memperbarui urutan', 'error');
        location.reload(); // Reload to sync with server
    });
}

// Toast notification functions
function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300 ${
        type === 'success' ? 'bg-green-500 text-white' :
        type === 'error' ? 'bg-red-500 text-white' :
        'bg-blue-500 text-white'
    }`;
    toast.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'} mr-2"></i>
            <span>${message}</span>
        </div>
    `;
    document.body.appendChild(toast);
    setTimeout(() => toast.classList.add('translate-x-0'), 10);
    return toast;
}

function hideToast(toast) {
    if (toast) {
        toast.classList.add('-translate-x-full');
        setTimeout(() => toast.remove(), 300);
    }
}
</script>

<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Include SortableJS for drag and drop -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<style>
/* Prevent text selection during drag */
.sortable-ghost {
    opacity: 0.5;
    background-color: #e0f2fe !important;
}

.sortable-drag {
    opacity: 0.8;
    background-color: #dbeafe !important;
}

.drag-handle {
    user-select: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
}

.criteria-row {
    user-select: none;
    -webkit-user-select: none;
}

.drag-handle:active {
    cursor: grabbing !important;
}

.drag-handle:hover {
    background-color: #f3f4f6;
}

/* Allow selection in buttons and inputs */
button, input, textarea, select {
    user-select: auto;
    -webkit-user-select: auto;
}
</style>

<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Include SortableJS for drag and drop -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
@endsection