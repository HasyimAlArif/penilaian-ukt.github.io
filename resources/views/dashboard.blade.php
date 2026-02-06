<x-app-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Dashboard</h1>
        <p class="text-gray-400">Selamat datang di sistem penilaian UKT Pagar Nusa</p>
    </div>

    <!-- Stats Grid -->
    <div class="responsive-grid-stats mb-6 sm:mb-8">
        <div class="glass-card rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-lg bg-blue-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-gray-400 text-sm">Total Petugas</p>
            <p class="text-2xl font-bold">{{ $totalPetugas }}</p>
        </div>

        <div class="glass-card rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-lg bg-green-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-gray-400 text-sm">Total Penilaian</p>
            <p class="text-2xl font-bold">{{ $totalPeserta }}</p>
        </div>

        <div class="glass-card rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-lg bg-yellow-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-gray-400 text-sm">Total Soal</p>
            <p class="text-2xl font-bold">{{ $totalSoal }}</p>
        </div>

        <div class="glass-card rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-lg bg-purple-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
            </div>
            <p class="text-gray-400 text-sm">Tingkatan</p>
            <p class="text-2xl font-bold">6</p>
        </div>
    </div>

    <!-- Tingkatan Cards -->
    <h2 class="text-lg sm:text-xl font-bold mb-3 sm:mb-4">Tingkatan Sabuk</h2>
    <div class="responsive-grid-tingkatan mb-6 sm:mb-8">
        <div class="card-white rounded-xl p-6 text-gray-800 transition transform hover:-translate-y-2 hover:shadow-lg cursor-pointer">
            <div class="text-center">
                <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-white border-4 border-gray-300 flex items-center justify-center text-xl">🥋</div>
                <h3 class="font-bold text-lg">PUTIH</h3>
                <p class="text-xs text-gray-600">Tingkat Dasar</p>
            </div>
        </div>
        <div class="card-yellow rounded-xl p-6 text-gray-800 transition transform hover:-translate-y-2 hover:shadow-lg cursor-pointer">
            <div class="text-center">
                <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-yellow-400 border-4 border-yellow-200 flex items-center justify-center text-xl">🥋</div>
                <h3 class="font-bold text-lg">KUNING</h3>
                <p class="text-xs text-gray-700">Tingkat Pemula</p>
            </div>
        </div>
        <div class="card-red rounded-xl p-6 text-white transition transform hover:-translate-y-2 hover:shadow-lg cursor-pointer">
            <div class="text-center">
                <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-red-600 border-4 border-red-400 flex items-center justify-center text-xl">🥋</div>
                <h3 class="font-bold text-lg">MERAH</h3>
                <p class="text-xs text-white/80">Tingkat Madya</p>
            </div>
        </div>
        <div class="card-blue rounded-xl p-6 text-white transition transform hover:-translate-y-2 hover:shadow-lg cursor-pointer">
            <div class="text-center">
                <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-blue-600 border-4 border-blue-400 flex items-center justify-center text-xl">🥋</div>
                <h3 class="font-bold text-lg">BIRU</h3>
                <p class="text-xs text-white/80">Tingkat Lanjut</p>
            </div>
        </div>
        <div class="card-brown rounded-xl p-6 text-white transition transform hover:-translate-y-2 hover:shadow-lg cursor-pointer">
            <div class="text-center">
                <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-[#5d4037] border-4 border-[#8d6e63] flex items-center justify-center text-xl">🥋</div>
                <h3 class="font-bold text-lg">COKLAT</h3>
                <p class="text-xs text-white/80">Tingkat Utama</p>
            </div>
        </div>
        <div class="card-black rounded-xl p-6 text-white transition transform hover:-translate-y-2 hover:shadow-lg cursor-pointer">
            <div class="text-center">
                <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-black border-4 border-gray-700 flex items-center justify-center text-xl">🥋</div>
                <h3 class="font-bold text-lg">HITAM</h3>
                <p class="text-xs text-white/80">Tingkat Akhir</p>
            </div>
        </div>
    </div>
    
    <!-- Recent Activity -->
    <h2 class="text-xl font-bold mb-4">Penilaian Terbaru</h2>
    <div class="glass-card rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
        <table class="w-full text-left min-w-[600px]">
            <thead class="bg-white/5 uppercase text-xs text-gray-400">
                <tr>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Nama Peserta</th>
                    <th class="px-6 py-4">Tingkatan</th>
                    <th class="px-6 py-4 text-center">Rata-rata</th>
                    <th class="px-6 py-4">Petugas</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($recentPenilaian as $penilaian)
                <tr class="table-row">
                    <td class="px-6 py-4">{{ $penilaian->tanggal->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4 font-medium">{{ $penilaian->name }}</td>
                    <td class="px-6 py-4">
                        <span class="tingkatan-badge badge-{{ strtolower($penilaian->tingkatan) }}">
                            {{ $penilaian->tingkatan }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="font-bold {{ $penilaian->rata_rata >= 75 ? 'text-green-400' : 'text-yellow-400' }}">
                            {{ $penilaian->rata_rata }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-400">{{ $penilaian->petugas }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        Belum ada data penilaian
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
</x-app-layout>
