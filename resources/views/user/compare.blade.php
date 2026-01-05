<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                    Perbandingan Villa
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Bandingkan 2-3 villa untuk membantu mengambil keputusan terbaik
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
                <p class="text-sm text-gray-600 mb-4">Pilih 2-3 villa untuk dibandingkan secara detail</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4" id="compareSlots">
                    @for($i = 0; $i < 3; $i++)
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center min-h-[200px] flex flex-col items-center justify-center compare-slot" id="slot{{ $i }}" data-slot="{{ $i }}">
                        <i class="fas fa-plus-circle text-gray-400 text-3xl mb-2"></i>
                        <p class="text-sm text-gray-500">Pilih Villa {{ $i + 1 }}</p>
                        <button onclick="openVillaModal({{ $i }})" class="mt-2 text-primary-600 hover:text-primary-700 text-sm font-medium">
                            <i class="fas fa-search mr-1"></i>Pilih Villa
                        </button>
                    </div>
                    @endfor
                </div>

                <div class="mt-4 flex justify-center">
                    <button onclick="compareVillas()" id="compareBtn" disabled class="px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-medium disabled:bg-gray-300 disabled:cursor-not-allowed">
                        <i class="fas fa-balance-scale mr-2"></i>Bandingkan Villa
                    </button>
                </div>
            </div>

            <!-- Comparison Table -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8" id="comparisonTable" style="display: none;">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-900">
                        <i class="fas fa-table text-primary-600 mr-2"></i>
                        Tabel Perbandingan
                    </h3>
                    <div class="flex items-center space-x-2 text-sm text-gray-600">
                        <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 rounded">
                            <i class="fas fa-star mr-1"></i>Nilai Terbaik
                        </span>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300" id="comparisonTableBody">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700 w-48">Kriteria</th>
                                <th class="border border-gray-300 px-4 py-3 text-center text-sm font-medium text-gray-700 villa-header" id="header0" style="display: none;">Villa 1</th>
                                <th class="border border-gray-300 px-4 py-3 text-center text-sm font-medium text-gray-700 villa-header" id="header1" style="display: none;">Villa 2</th>
                                <th class="border border-gray-300 px-4 py-3 text-center text-sm font-medium text-gray-700 villa-header" id="header2" style="display: none;">Villa 3</th>
                            </tr>
                        </thead>
                        <tbody id="criteriaRows">
                            <!-- Will be populated by JavaScript -->
                        </tbody>
                        <tfoot>
                            <tr class="bg-primary-50 font-bold">
                                <td class="border border-gray-300 px-4 py-3 text-gray-900">
                                    <i class="fas fa-trophy text-yellow-500 mr-2"></i>Skor TOPSIS (Vi)
                                </td>
                                <td class="border border-gray-300 px-4 py-3 text-center text-primary-600 villa-score" id="score0" style="display: none;">-</td>
                                <td class="border border-gray-300 px-4 py-3 text-center text-primary-600 villa-score" id="score1" style="display: none;">-</td>
                                <td class="border border-gray-300 px-4 py-3 text-center text-primary-600 villa-score" id="score2" style="display: none;">-</td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="border border-gray-300 px-4 py-3 text-gray-700">Ranking</td>
                                <td class="border border-gray-300 px-4 py-3 text-center villa-rank" id="rank0" style="display: none;">-</td>
                                <td class="border border-gray-300 px-4 py-3 text-center villa-rank" id="rank1" style="display: none;">-</td>
                                <td class="border border-gray-300 px-4 py-3 text-center villa-rank" id="rank2" style="display: none;">-</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Winner Section -->
                <div id="winnerSection" class="mt-6 p-4 bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-lg border border-yellow-300" style="display: none;">
                    <div class="flex items-center">
                        <div class="text-4xl mr-4">🏆</div>
                        <div>
                            <h4 class="font-bold text-lg text-yellow-800">Rekomendasi Terbaik</h4>
                            <p class="text-yellow-700" id="winnerName">-</p>
                            <p class="text-sm text-yellow-600" id="winnerScore">Skor: -</p>
                        </div>
                    </div>
                </div>

                <!-- Criteria Highlights -->
                <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                    <h4 class="font-semibold text-blue-900 mb-3">
                        <i class="fas fa-lightbulb mr-2"></i>Analisis Perbandingan
                    </h4>
                    <div id="analysisContent" class="text-sm text-blue-800 space-y-2">
                        <!-- Will be populated by JavaScript -->
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between items-center bg-white rounded-xl shadow-lg p-6">
                <a href="{{ route('results') }}" class="flex items-center px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
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
        <div class="bg-white rounded-xl shadow-2xl max-w-3xl w-full max-h-[80vh] overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-gray-900">
                        <i class="fas fa-home text-primary-600 mr-2"></i>Pilih Villa
                    </h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div class="mt-3">
                    <input type="text" id="villaSearch" placeholder="Cari villa..." 
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        onkeyup="filterVillas()">
                </div>
            </div>
            <div class="p-6 overflow-y-auto max-h-[60vh]">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="villaList">
                    @foreach($allVillas ?? [] as $villa)
                    <div onclick="chooseVilla({{ $villa->id }}, '{{ addslashes($villa->name) }}', '{{ addslashes($villa->location ?? '') }}', {{ $villa->price ?? 0 }}, {{ $villaScores[$villa->id]['score'] ?? 0 }}, {{ $villaScores[$villa->id]['rank'] ?? 0 }})" 
                        class="villa-option border border-gray-200 rounded-lg p-4 hover:border-primary-500 hover:shadow-md cursor-pointer transition"
                        data-villa-id="{{ $villa->id }}"
                        data-villa-name="{{ strtolower($villa->name) }}">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-1">{{ $villa->name }}</h4>
                                <p class="text-sm text-gray-600 mb-2">
                                    <i class="fas fa-map-marker-alt text-gray-400 mr-1"></i>
                                    {{ Str::limit($villa->location ?? 'Lokasi tidak tersedia', 30) }}
                                </p>
                                <p class="text-primary-600 font-bold">Rp {{ number_format($villa->price ?? 0, 0, ',', '.') }}/malam</p>
                            </div>
                            <div class="text-right ml-2">
                                <span class="text-xs text-gray-500">Ranking</span>
                                <p class="text-lg font-bold text-primary-600">#{{ $villaScores[$villa->id]['rank'] ?? '-' }}</p>
                                <p class="text-xs text-gray-500">{{ number_format($villaScores[$villa->id]['score'] ?? 0, 4) }}</p>
                            </div>
                        </div>
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <span class="mr-3"><i class="fas fa-users mr-1"></i>{{ $villa->capacity ?? 0 }} orang</span>
                            <span><i class="fas fa-star text-yellow-400 mr-1"></i>{{ number_format($villa->rating ?? 0, 1) }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedSlot = null;
        let selectedVillas = {};
        const criteriaData = @json($criteria ?? []);
        const allVillaScores = @json($villaScores ?? []);

        function openVillaModal(slotIndex) {
            selectedSlot = slotIndex;
            document.getElementById('villaModal').classList.remove('hidden');
            document.getElementById('villaSearch').value = '';
            filterVillas();
            
            // Hide already selected villas
            document.querySelectorAll('.villa-option').forEach(el => {
                const villaId = parseInt(el.dataset.villaId);
                const isSelected = Object.values(selectedVillas).some(v => v.id === villaId);
                el.style.display = isSelected ? 'none' : 'block';
            });
        }

        function closeModal() {
            document.getElementById('villaModal').classList.add('hidden');
            selectedSlot = null;
        }

        function filterVillas() {
            const search = document.getElementById('villaSearch').value.toLowerCase();
            document.querySelectorAll('.villa-option').forEach(el => {
                const name = el.dataset.villaName;
                const villaId = parseInt(el.dataset.villaId);
                const isSelected = Object.values(selectedVillas).some(v => v.id === villaId);
                
                if (isSelected) {
                    el.style.display = 'none';
                } else {
                    el.style.display = name.includes(search) ? 'block' : 'none';
                }
            });
        }

        function chooseVilla(villaId, villaName, location, price, score, rank) {
            if (selectedSlot !== null) {
                selectedVillas[selectedSlot] = { 
                    id: villaId, 
                    name: villaName, 
                    location: location,
                    price: price,
                    score: score,
                    rank: rank
                };
                updateSlotDisplay(selectedSlot);
                closeModal();
                updateCompareButton();
                saveToLocalStorage();
            }
        }

        function updateSlotDisplay(slotIndex) {
            const villa = selectedVillas[slotIndex];
            const slot = document.getElementById(`slot${slotIndex}`);
            
            slot.innerHTML = `
                <div class="w-full text-left">
                    <div class="flex justify-between items-start mb-2">
                        <h4 class="font-semibold text-gray-900">${villa.name}</h4>
                        <button onclick="event.stopPropagation(); removeVilla(${slotIndex})" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <p class="text-sm text-gray-600 mb-1">
                        <i class="fas fa-map-marker-alt text-gray-400 mr-1"></i>${villa.location || 'Lokasi tidak tersedia'}
                    </p>
                    <p class="text-primary-600 font-bold mb-2">Rp ${villa.price.toLocaleString('id-ID')}/malam</p>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Ranking: #${villa.rank}</span>
                        <span class="text-primary-600 font-medium">Skor: ${villa.score.toFixed(4)}</span>
                    </div>
                </div>
            `;
            slot.classList.remove('border-dashed', 'border-gray-300');
            slot.classList.add('border-solid', 'border-primary-500', 'bg-primary-50');
        }

        function removeVilla(slotIndex) {
            delete selectedVillas[slotIndex];
            const slot = document.getElementById(`slot${slotIndex}`);
            
            slot.innerHTML = `
                <i class="fas fa-plus-circle text-gray-400 text-3xl mb-2"></i>
                <p class="text-sm text-gray-500">Pilih Villa ${slotIndex + 1}</p>
                <button onclick="openVillaModal(${slotIndex})" class="mt-2 text-primary-600 hover:text-primary-700 text-sm font-medium">
                    <i class="fas fa-search mr-1"></i>Pilih Villa
                </button>
            `;
            slot.classList.add('border-dashed', 'border-gray-300');
            slot.classList.remove('border-solid', 'border-primary-500', 'bg-primary-50');
            
            updateCompareButton();
            document.getElementById('comparisonTable').style.display = 'none';
            saveToLocalStorage();
        }

        function updateCompareButton() {
            const count = Object.keys(selectedVillas).length;
            const btn = document.getElementById('compareBtn');
            btn.disabled = count < 2;
        }

        function compareVillas() {
            const villaIds = Object.values(selectedVillas).map(v => v.id);
            
            if (villaIds.length < 2) {
                alert('Pilih minimal 2 villa untuk dibandingkan');
                return;
            }

            // Show loading
            document.getElementById('compareBtn').innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
            document.getElementById('compareBtn').disabled = true;

            // Fetch comparison data
            fetch('{{ route("user.compare.data") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ villa_ids: villaIds })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayComparison(data);
                } else {
                    alert('Gagal memuat data perbandingan');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            })
            .finally(() => {
                document.getElementById('compareBtn').innerHTML = '<i class="fas fa-balance-scale mr-2"></i>Bandingkan Villa';
                document.getElementById('compareBtn').disabled = false;
            });
        }

        function displayComparison(data) {
            const villas = data.villas;
            const criteria = data.criteria;
            const bestValues = data.best_values;

            // Show table
            document.getElementById('comparisonTable').style.display = 'block';

            // Update headers
            villas.forEach((villa, index) => {
                const header = document.getElementById(`header${index}`);
                header.textContent = villa.name;
                header.style.display = 'table-cell';
                
                document.getElementById(`score${index}`).style.display = 'table-cell';
                document.getElementById(`rank${index}`).style.display = 'table-cell';
            });

            // Hide unused columns
            for (let i = villas.length; i < 3; i++) {
                document.getElementById(`header${i}`).style.display = 'none';
                document.getElementById(`score${i}`).style.display = 'none';
                document.getElementById(`rank${i}`).style.display = 'none';
            }

            // Build criteria rows
            let rowsHtml = '';
            criteria.forEach((criterion, rowIndex) => {
                rowsHtml += `<tr class="${rowIndex % 2 === 0 ? 'bg-white' : 'bg-gray-50'}">`;
                rowsHtml += `<td class="border border-gray-300 px-4 py-3 font-medium text-gray-900">
                    ${criterion.name}
                    <span class="text-xs text-gray-500 ml-1">(${(criterion.weight * 100).toFixed(1)}%)</span>
                </td>`;
                
                villas.forEach((villa, colIndex) => {
                    const criteriaValue = villa.criteria_values[criterion.id];
                    const isBest = criteriaValue && parseFloat(criteriaValue.value) === parseFloat(bestValues[criterion.id]);
                    const bgClass = isBest ? 'bg-green-100 text-green-800 font-semibold' : '';
                    
                    rowsHtml += `<td class="border border-gray-300 px-4 py-3 text-center ${bgClass}" style="display: table-cell;">
                        ${criteriaValue ? criteriaValue.formatted : '-'}
                        ${isBest ? '<i class="fas fa-star text-yellow-500 ml-1"></i>' : ''}
                    </td>`;
                });
                
                // Add empty cells for unused columns
                for (let i = villas.length; i < 3; i++) {
                    rowsHtml += `<td class="border border-gray-300 px-4 py-3 text-center" style="display: none;">-</td>`;
                }
                
                rowsHtml += '</tr>';
            });

            document.getElementById('criteriaRows').innerHTML = rowsHtml;

            // Update scores and ranks
            let winner = villas[0];
            villas.forEach((villa, index) => {
                document.getElementById(`score${index}`).innerHTML = `
                    <span class="text-lg">${villa.score.toFixed(4)}</span>
                `;
                
                const rankBadge = villa.rank <= 3 ? 
                    ['🥇', '🥈', '🥉'][villa.rank - 1] : 
                    `#${villa.rank}`;
                document.getElementById(`rank${index}`).innerHTML = `
                    <span class="text-lg">${rankBadge}</span>
                `;
                
                if (villa.score > winner.score) {
                    winner = villa;
                }
            });

            // Show winner
            document.getElementById('winnerSection').style.display = 'block';
            document.getElementById('winnerName').textContent = winner.name;
            document.getElementById('winnerScore').textContent = `Skor TOPSIS: ${winner.score.toFixed(4)} | Ranking: #${winner.rank}`;

            // Generate analysis
            generateAnalysis(villas, criteria, bestValues);

            // Scroll to table
            document.getElementById('comparisonTable').scrollIntoView({ behavior: 'smooth' });
        }

        function generateAnalysis(villas, criteria, bestValues) {
            let analysis = [];
            
            // Find winner
            const winner = villas.reduce((a, b) => a.score > b.score ? a : b);
            analysis.push(`<p><strong>${winner.name}</strong> memiliki skor TOPSIS tertinggi (${winner.score.toFixed(4)}) dan merupakan rekomendasi terbaik berdasarkan semua kriteria.</p>`);

            // Analyze each villa's strengths
            villas.forEach(villa => {
                let strengths = [];
                criteria.forEach(criterion => {
                    const criteriaValue = villa.criteria_values[criterion.id];
                    if (criteriaValue && parseFloat(criteriaValue.value) === parseFloat(bestValues[criterion.id])) {
                        strengths.push(criterion.name);
                    }
                });
                
                if (strengths.length > 0) {
                    analysis.push(`<p><strong>${villa.name}</strong> unggul dalam: ${strengths.join(', ')}</p>`);
                }
            });

            // Price comparison
            const cheapest = villas.reduce((a, b) => a.price < b.price ? a : b);
            const mostExpensive = villas.reduce((a, b) => a.price > b.price ? a : b);
            if (cheapest.id !== mostExpensive.id) {
                const priceDiff = mostExpensive.price - cheapest.price;
                analysis.push(`<p>Selisih harga antara villa termurah (<strong>${cheapest.name}</strong>) dan termahal (<strong>${mostExpensive.name}</strong>) adalah <strong>Rp ${priceDiff.toLocaleString('id-ID')}</strong>/malam.</p>`);
            }

            document.getElementById('analysisContent').innerHTML = analysis.join('');
        }

        function clearComparison() {
            if (Object.keys(selectedVillas).length === 0 || confirm('Apakah Anda yakin ingin menghapus semua perbandingan?')) {
                selectedVillas = {};
                for (let i = 0; i < 3; i++) {
                    removeVilla(i);
                }
                document.getElementById('comparisonTable').style.display = 'none';
                // Clear localStorage
                localStorage.removeItem('villaCompareList');
            }
        }

        function saveToLocalStorage() {
            const compareList = Object.values(selectedVillas);
            localStorage.setItem('villaCompareList', JSON.stringify(compareList));
        }

        function loadFromLocalStorage() {
            const savedCompare = localStorage.getItem('villaCompareList');
            if (savedCompare) {
                try {
                    const villaList = JSON.parse(savedCompare);
                    if (villaList && villaList.length > 0) {
                        villaList.forEach((villa, index) => {
                            if (index < 3 && villa.id) {
                                selectedVillas[index] = {
                                    id: villa.id,
                                    name: villa.name || 'Villa',
                                    location: villa.location || '',
                                    price: villa.price || 0,
                                    score: villa.score || 0,
                                    rank: villa.rank || 0
                                };
                                updateSlotDisplay(index);
                            }
                        });
                        updateCompareButton();
                        
                        // Auto compare if 2+ villas loaded
                        if (Object.keys(selectedVillas).length >= 2) {
                            setTimeout(() => {
                                compareVillas();
                            }, 500);
                        }
                    }
                } catch (e) {
                    console.error('Error loading compare list:', e);
                }
            }
        }

        // Load from localStorage on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadFromLocalStorage();
        });
    </script>
</x-app-layout>
