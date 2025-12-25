@extends('layouts.admin')

@section('page-title', 'Manajemen Pengguna')
@section('page-description', 'Kelola data pengguna sistem dan preferensi mereka')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-primary-600">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="bg-primary-100 p-3 rounded-full">
                    <i class="fas fa-users text-primary-600 text-xl"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Total Pengguna</p>
                <p class="text-2xl font-bold text-gray-900">{{ $users->total() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-600">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-user-check text-green-600 text-xl"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Aktif</p>
                <p class="text-2xl font-bold text-gray-900">{{ $users->where('email_verified_at', '!=', null)->count() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-600">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-sliders-h text-blue-600 text-xl"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Dengan Preferensi</p>
                <p class="text-2xl font-bold text-gray-900">{{ $users->where('preferences', '!=', null)->count() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-orange-600">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="bg-orange-100 p-3 rounded-full">
                    <i class="fas fa-calendar text-orange-600 text-xl"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Bulan Ini</p>
                <p class="text-2xl font-bold text-gray-900">{{ $users->where('created_at', '>=', now()->startOfMonth())->count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Users Table -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">
                            <i class="fas fa-list mr-2 text-primary-600"></i>
                            Daftar Pengguna
                        </h3>
                        <div class="flex items-center space-x-3">
                            <span class="text-sm text-gray-500">Total: {{ $users->total() }} pengguna</span>
                            <div class="relative">
                                <input type="text" id="searchInput" placeholder="Cari pengguna..." 
                                       class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" id="usersTable">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pengguna
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Bergabung
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Preferensi
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($users as $user)
                            <tr class="hover:bg-gray-50 user-row">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="bg-primary-100 w-10 h-10 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-primary-600"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 user-name">{{ $user->name }}</div>
                                            <div class="text-sm text-gray-500 user-email">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user->email_verified_at)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-clock mr-1"></i>
                                            Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->created_at->format('d M Y') }}
                                    <div class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user->preferences && $user->preferences->count() > 0)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <i class="fas fa-check mr-1"></i>
                                            {{ $user->preferences->count() }} preferensi
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            <i class="fas fa-minus mr-1"></i>
                                            Belum ada
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <button onclick="viewUser({{ $user->id }})" class="text-primary-600 hover:text-primary-700 bg-primary-50 hover:bg-primary-100 px-3 py-1 rounded-md transition-colors">
                                            <i class="fas fa-eye mr-1"></i>
                                            Lihat
                                        </button>
                                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="inline-block" 
                                              onsubmit="return confirm('Yakin ingin menghapus pengguna {{ $user->name }}?')">
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
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-users text-4xl text-gray-300 mb-4"></i>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada pengguna</h3>
                                        <p class="text-gray-500">Pengguna yang mendaftar akan muncul di sini.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($users->hasPages())
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    {{ $users->links() }}
                </div>
                @endif
            </div>

<!-- User Detail Modal -->
<div id="userModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="bg-white px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900">Detail Pengguna</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div id="modalContent" class="px-6 py-4">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('.user-row');
    let visibleRows = 0;
    
    rows.forEach(row => {
        const name = row.querySelector('.user-name').textContent.toLowerCase();
        const email = row.querySelector('.user-email').textContent.toLowerCase();
        
        if (name.includes(searchTerm) || email.includes(searchTerm)) {
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

// View user modal
function viewUser(userId) {
    document.getElementById('userModal').classList.remove('hidden');
    document.getElementById('modalContent').innerHTML = '<div class="text-center"><i class="fas fa-spinner fa-spin text-2xl text-gray-400"></i></div>';
    
    // In real implementation, fetch user details via AJAX
    setTimeout(() => {
        document.getElementById('modalContent').innerHTML = `
            <div class="space-y-4">
                <p><strong>ID:</strong> ${userId}</p>
                <p><strong>Status:</strong> <span class="text-green-600">Aktif</span></p>
                <p><strong>Bergabung:</strong> 1 hari yang lalu</p>
                <p><strong>Preferensi:</strong> 3 kriteria telah diisi</p>
            </div>
        `;
    }, 500);
}

function closeModal() {
    document.getElementById('userModal').classList.add('hidden');
}
</script>

<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection