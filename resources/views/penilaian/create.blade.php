<x-app-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Input Penilaian UKT</h1>
        <p class="text-gray-400">Masukkan nilai ujian peserta (Format: Lembar Nilai)</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <!-- Form Card -->
            <div class="glass-card rounded-xl p-8">
                <form method="GET" action="{{ route('penilaian.create') }}" id="form-tingkatan" class="mb-6">
                    <div>
                        <label for="tingkatan" class="block text-sm text-gray-300 mb-2">Pilih Tingkatan Sabuk</label>
                        <select id="tingkatan" name="tingkatan" onchange="this.form.submit()" class="input-field w-full px-4 py-3 rounded-lg text-white appearance-none cursor-pointer border-2 border-blue-500/50">
                            <option value="" disabled {{ !$tingkatan ? 'selected' : '' }}>-- Pilih Tingkatan --</option>
                            <option value="Putih" class="bg-gray-800" {{ $tingkatan == 'Putih' ? 'selected' : '' }}>Putih</option>
                            <option value="Kuning" class="bg-gray-800" {{ $tingkatan == 'Kuning' ? 'selected' : '' }}>Kuning</option>
                            <option value="Merah" class="bg-gray-800" {{ $tingkatan == 'Merah' ? 'selected' : '' }}>Merah</option>
                            <option value="Biru" class="bg-gray-800" {{ $tingkatan == 'Biru' ? 'selected' : '' }}>Biru</option>
                            <option value="Coklat" class="bg-gray-800" {{ $tingkatan == 'Coklat' ? 'selected' : '' }}>Coklat</option>
                            <option value="Hitam" class="bg-gray-800" {{ $tingkatan == 'Hitam' ? 'selected' : '' }}>Hitam</option>
                        </select>
                    </div>
                </form>

                @if($tingkatan)
                <form method="POST" action="{{ route('penilaian.store') }}" class="space-y-6 animate-fade-in">
                    @csrf
                    <input type="hidden" name="tingkatan" value="{{ $tingkatan }}">

                    <!-- Nama Peserta -->
                    <div>
                        <label for="name" class="block text-sm text-gray-300 mb-2">Nama Peserta</label>
                        <input id="name" class="input-field w-full px-4 py-3 rounded-lg text-white" 
                               type="text" name="name" value="{{ old('name') }}" required placeholder="Nama Lengkap Peserta">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="border-t border-white/10 my-6"></div>

                    <!-- Dynamic Questions Grouped by Category -->
                    <div class="space-y-8">
                        @php
                            $categories = [
                                'SALAM PAGAR NUSA',
                                'TEKNIK DASAR PUKULAN',
                                'TEKNIK DASAR TANGKISAN',
                                'TEKNIK DASAR TENDANGAN',
                                'TEKNIK DASAR PAGAR NUSA',
                                'FISIK',
                                'TEKNIK SERANG BALAS',
                                'JURUS WAJIB IPSI'
                            ];
                            $groupedSoal = $soal->groupBy('kategori');
                        @endphp

                        @foreach($categories as $index => $category)
                            <div class="glass-card bg-white/5 rounded-xl p-6">
                                <h3 class="text-lg font-bold mb-4 flex items-center gap-3 text-white">
                                    <span class="w-8 h-8 rounded-lg bg-red-500/20 flex items-center justify-center text-sm font-bold text-red-300">{{ $index + 1 }}</span>
                                    {{ $category }}
                                </h3>

                                @if(isset($groupedSoal[$category]) && count($groupedSoal[$category]) > 0)
                                    <div class="space-y-4">
                                        @foreach($groupedSoal[$category] as $item)
                                            <div class="flex flex-col md:flex-row md:items-start gap-4 p-4 bg-black/20 rounded-lg">
                                                <div class="flex-1 pt-1">
                                                    <label class="text-gray-200 font-medium">{{ $item->soal }}</label>
                                                </div>
                                                <div class="flex gap-3 w-full md:w-auto">
                                                    <div class="w-24">
                                                        <label class="text-xs text-gray-400 block mb-1 text-center">Nilai</label>
                                                        <input type="number" name="nilai[{{ $item->id }}]" 
                                                               min="0" max="100" step="1"
                                                               class="input-field w-full px-3 py-2 rounded-lg text-white text-center font-bold bg-black/40 border-white/10 focus:border-blue-500"
                                                               placeholder="0-100" required>
                                                    </div>
                                                    <div class="w-48">
                                                        <label class="text-xs text-gray-400 block mb-1 text-center">Huruf</label>
                                                        <input type="text" name="huruf[{{ $item->id }}]" 
                                                               class="input-field w-full px-3 py-2 rounded-lg text-white text-sm bg-black/40 border-white/10 focus:border-blue-500"
                                                               placeholder="Contoh: Delapan Puluh">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                    <!-- Realtime Calculation -->
                                    <div class="mt-4 p-3 bg-white/5 rounded-lg border border-white/5">
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-400">Total Nilai {{ $category }}</span>
                                            <span class="font-bold text-lg text-white" id="total-{{ Str::slug($category) }}">0</span>
                                        </div>
                                        <div class="flex justify-between items-center mt-2">
                                            <span class="text-sm text-gray-400">Rata-rata</span>
                                            <span class="font-bold text-lg text-green-400" id="avg-{{ Str::slug($category) }}">0</span>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center py-4 text-gray-500 text-sm italic border border-dashed border-gray-600 rounded-lg">
                                        Belum ada soal untuk kategori ini.
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Grand Total Sticky Footer -->
                    <div class="flex items-center justify-between gap-4 pt-4 pb-4 border-t border-white/10 sticky bottom-0 bg-[#1a1a2e]/95 p-4 backdrop-blur-md rounded-t-xl z-10 shadow-2xl border-x border-t border-white/10">
                        <div class="hidden md:block">
                            <p class="text-xs text-gray-400 uppercase tracking-wider">Nilai Akhir</p>
                            <p class="text-3xl font-bold text-blue-400" id="grand-total">0.0</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('penilaian.index') }}" class="px-4 py-3 rounded-lg bg-white/5 hover:bg-white/10 text-gray-300 transition font-medium">
                                Batal
                            </a>
                            <button type="submit" class="btn-primary px-6 py-3 rounded-lg text-white font-bold shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 transition transform hover:-translate-y-1">
                                SIMPAN PENILAIAN
                            </button>
                        </div>
                    </div>
                </form>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const categories = @json($categories);
                        
                        function calculate() {
                            let grandTotalAvg = 0;
                            let activeCategories = 0;

                            categories.forEach(category => {
                                // Find all inputs for this category
                                // We iterate through the DOM to find inputs belonging to this category
                                // Since we don't have a direct category attribute on inputs, we rely on the grouping structure or we can add data attributes.
                                // Let's try a robust approach: Look for the container of the category.
                                
                                const slug = category.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
                                const totalEl = document.getElementById(`total-${slug}`);
                                const avgEl = document.getElementById(`avg-${slug}`);
                                
                                if (!totalEl) return; // Category might be empty or not rendered
                                
                                // Find key inputs within the same card container
                                const card = totalEl.closest('.glass-card');
                                const inputs = card.querySelectorAll('input[type="number"]');
                                
                                let total = 0;
                                let count = 0;
                                
                                inputs.forEach(input => {
                                    const val = parseFloat(input.value);
                                    if (!isNaN(val)) {
                                        total += val;
                                        count++;
                                    }
                                });
                                
                                const avg = count > 0 ? (total / count) : 0;
                                
                                // Update UI
                                totalEl.textContent = total;
                                avgEl.textContent = avg.toFixed(1);
                                
                                if (count > 0) {
                                    grandTotalAvg += avg;
                                    activeCategories++;
                                }
                            });
                            
                            // Calculate Grand Total (Average of Averages)
                            const finalScore = activeCategories > 0 ? (grandTotalAvg / activeCategories) : 0;
                            document.getElementById('grand-total').textContent = finalScore.toFixed(1);
                        }

                        // Attach event listeners
                        document.querySelectorAll('input[type="number"]').forEach(input => {
                            input.addEventListener('input', calculate);
                        });
                        
                        // Initial calculation
                        calculate();
                    });
                </script>
                @else
                <div class="text-center py-12">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-white/5 flex items-center justify-center animate-pulse">
                        <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <p class="text-gray-400">Silahkan pilih tingkatan sabuk di atas untuk memuat lembar penilaian.</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Info Sidebar -->
        <div class="lg:col-span-1">
            <div class="glass-card rounded-xl p-6 sticky top-6">
                <h3 class="font-bold text-lg mb-4 text-white">Panduan Penilai</h3>
                <ul class="space-y-3 text-sm text-gray-300">
                    <li class="flex gap-2">
                        <span class="text-blue-400 font-bold">1.</span>
                        <span>Form ini menyesuaikan dengan Lembar Penilaian UKT manual.</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-blue-400 font-bold">2.</span>
                        <span>Beri nilai <b>0 - 100</b> untuk setiap teknik/gerakan.</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-blue-400 font-bold">3.</span>
                        <span>Sistem otomatis menghitung <b>Rata-rata Kategori</b> dan <b>Nilai Akhir</b>.</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-blue-400 font-bold">4.</span>
                        <span>Jika soal kosong pada suatu kategori, kategori tersebut tidak dihitung dalam rata-rata.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
