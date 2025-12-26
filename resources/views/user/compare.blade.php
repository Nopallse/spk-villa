<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                    Perbandingan Villa
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Bandingkan villa untuk membantu mengambil keputusan akhir
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Select Villa Section -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">
                    <i class="fas fa-plus-circle text-primary-600 mr-2"></i>
                    Pilih Villa untuk Dibandingkan
                </h3>
                <p class="text-sm text-gray-600 mb-4">Pilih 2-3 villa untuk dibandingkan</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4" id="compareSlots">
                    @for($i = 0; $i < 3; $i++)
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center min-h-[200px] flex flex-col items-center justify-center" id="slot{{ $i }}">
                        <i class="fas fa-plus-circle text-gray-400 text-3xl mb-2"></i>
                        <p class="text-sm text-gray-500">Pilih Villa {{ $i + 1 }}</p>
                        <button onclick="selectVilla({{ $i }})" class="mt-2 text-primary-600 hover:text-primary-700 text-sm font-medium">
                            Pilih Villa
                        </button>
                    </div>
                    @endfor
                </div>
            </div>

            <!-- Comparison Table -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8" id="comparisonTable" style="display: none;">
                <h3 class="text-xl font-semibold text-gray-900 mb-6">
                    <i class="fas fa-table text-primary-600 mr-2"></i>
                    Tabel Perbandingan
                </h3>
                
                @php
                    $criteria = \App\Models\Criteria::active()->ordered()->get();
                @endphp
                
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">Kriteria</th>
                                <th class="border border-gray-300 px-4 py-3 text-center text-sm font-medium text-gray-700" id="villa1Header">Villa 1</th>
                                <th class="border border-gray-300 px-4 py-3 text-center text-sm font-medium text-gray-700" id="villa2Header">Villa 2</th>
                                <th class="border border-gray-300 px-4 py-3 text-center text-sm font-medium text-gray-700" id="villa3Header" style="display: none;">Villa 3</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($criteria as $criterion)
                            <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                                <td class="border border-gray-300 px-4 py-3 font-medium text-gray-900">
                                    {{ $criterion->name }}
                                </td>
                                <td class="border border-gray-300 px-4 py-3 text-center" id="villa1_{{ $criterion->id }}">
                                    -
                                </td>
                                <td class="border border-gray-300 px-4 py-3 text-center" id="villa2_{{ $criterion->id }}">
                                    -
                                </td>
                                <td class="border border-gray-300 px-4 py-3 text-center" id="villa3_{{ $criterion->id }}" style="display: none;">
                                    -
                                </td>
                            </tr>
                            @endforeach
                            <tr class="bg-primary-50 font-bold">
                                <td class="border border-gray-300 px-4 py-3 text-gray-900">Skor Akhir (Vi)</td>
                                <td class="border border-gray-300 px-4 py-3 text-center text-primary-600" id="villa1Score">-</td>
                                <td class="border border-gray-300 px-4 py-3 text-center text-primary-600" id="villa2Score">-</td>
                                <td class="border border-gray-300 px-4 py-3 text-center text-primary-600" id="villa3Score" style="display: none;">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                    <h4 class="font-semibold text-blue-900 mb-2">Kriteria Unggulan:</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4" id="highlightCriteria">
                        <!-- Will be populated by JavaScript -->
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between items-center bg-white rounded-xl shadow-lg p-6">
                <a href="{{ route('user.recommendations.index') }}" class="flex items-center px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Rekomendasi
                </a>
                
                <div class="flex space-x-4">
                    <button onclick="clearComparison()" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        <i class="fas fa-redo mr-2"></i>Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Villa Selection Modal -->
    <div id="villaModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full max-h-[80vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-gray-900">Pilih Villa</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="villaList">
                    @php
                        $allVillas = \App\Models\Villa::where('is_active', true)->get();
                    @endphp
                    @foreach($allVillas as $villa)
                    <div onclick="chooseVilla({{ $villa->id }}, '{{ $villa->name }}')" class="border border-gray-200 rounded-lg p-4 hover:border-primary-500 hover:shadow-md cursor-pointer transition">
                        <h4 class="font-semibold text-gray-900 mb-1">{{ $villa->name }}</h4>
                        <p class="text-sm text-gray-600 mb-2">{{ Str::limit($villa->address, 40) }}</p>
                        <p class="text-primary-600 font-bold">Rp {{ number_format($villa->price_per_night ?? 0, 0, ',', '.') }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedSlot = null;
        let selectedVillas = {};

        function selectVilla(slotIndex) {
            selectedSlot = slotIndex;
            document.getElementById('villaModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('villaModal').classList.add('hidden');
            selectedSlot = null;
        }

        function chooseVilla(villaId, villaName) {
            if (selectedSlot !== null) {
                selectedVillas[selectedSlot] = { id: villaId, name: villaName };
                updateSlot(selectedSlot, villaName);
                closeModal();
                updateComparisonTable();
            }
        }

        function updateSlot(slotIndex, villaName) {
            const slot = document.getElementById(`slot${slotIndex}`);
            slot.innerHTML = `
                <div class="w-full">
                    <h4 class="font-semibold text-gray-900 mb-2">${villaName}</h4>
                    <button onclick="removeVilla(${slotIndex})" class="text-red-600 hover:text-red-700 text-sm">
                        <i class="fas fa-times mr-1"></i>Hapus
                    </button>
                </div>
            `;
            slot.classList.remove('border-dashed');
            slot.classList.add('border-solid', 'border-primary-500');
        }

        function removeVilla(slotIndex) {
            delete selectedVillas[slotIndex];
            const slot = document.getElementById(`slot${slotIndex}`);
            slot.innerHTML = `
                <i class="fas fa-plus-circle text-gray-400 text-3xl mb-2"></i>
                <p class="text-sm text-gray-500">Pilih Villa ${slotIndex + 1}</p>
                <button onclick="selectVilla(${slotIndex})" class="mt-2 text-primary-600 hover:text-primary-700 text-sm font-medium">
                    Pilih Villa
                </button>
            `;
            slot.classList.add('border-dashed');
            slot.classList.remove('border-solid', 'border-primary-500');
            updateComparisonTable();
        }

        function updateComparisonTable() {
            const villaCount = Object.keys(selectedVillas).length;
            if (villaCount >= 2) {
                document.getElementById('comparisonTable').style.display = 'block';
                // Update headers
                Object.keys(selectedVillas).forEach((slot, index) => {
                    document.getElementById(`villa${parseInt(slot)+1}Header`).textContent = selectedVillas[slot].name;
                });
                // Show/hide third column
                if (villaCount === 3) {
                    document.getElementById('villa3Header').style.display = 'table-cell';
                    document.querySelectorAll('[id^="villa3_"]').forEach(el => el.style.display = 'table-cell');
                } else {
                    document.getElementById('villa3Header').style.display = 'none';
                    document.querySelectorAll('[id^="villa3_"]').forEach(el => el.style.display = 'none');
                }
                // Populate data (mock data for now)
                Object.keys(selectedVillas).forEach((slot, index) => {
                    const villaId = selectedVillas[slot].id;
                    const slotNum = parseInt(slot) + 1;
                    // Mock scores - update all criteria cells
                    const criteriaIds = @json($criteria->pluck('id')->toArray());
                    criteriaIds.forEach(function(criteriaId) {
                        const cellId = `villa${slotNum}_${criteriaId}`;
                        const cell = document.getElementById(cellId);
                        if (cell) {
                            cell.textContent = '8.5';
                        }
                    });
                    const scoreCell = document.getElementById(`villa${slotNum}Score`);
                    if (scoreCell) {
                        scoreCell.textContent = (0.9 - index * 0.1).toFixed(3);
                    }
                });
            } else {
                document.getElementById('comparisonTable').style.display = 'none';
            }
        }

        function clearComparison() {
            if (confirm('Apakah Anda yakin ingin menghapus semua perbandingan?')) {
                selectedVillas = {};
                for (let i = 0; i < 3; i++) {
                    removeVilla(i);
                }
            }
        }
    </script>
</x-app-layout>

