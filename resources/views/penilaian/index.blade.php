<x-app-layout>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold">Rekap Penilaian</h1>
            <p class="text-gray-400">Riwayat hasil ujian peserta</p>
        </div>
        <a href="{{ route('penilaian.create') }}" class="btn-primary px-4 py-2 rounded-lg text-white font-medium flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Input Penilaian Baru
        </a>
    </div>

    <!-- Penilaian Table -->
    <div class="glass-card rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
        <table class="w-full text-left min-w-[700px]">
            <thead class="bg-white/5 uppercase text-xs text-gray-400">
                <tr>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Nama Peserta</th>
                    <th class="px-6 py-4">Tingkatan</th>
                    <th class="px-6 py-4 text-center">Rata-rata</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Petugas</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($penilaian as $item)
                <tr class="table-row">
                    <td class="px-6 py-4 text-gray-400 font-mono text-sm">{{ $item->tanggal->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4 font-medium">{{ $item->name }}</td>
                    <td class="px-6 py-4">
                        <span class="tingkatan-badge badge-{{ strtolower($item->tingkatan) }}">
                            {{ $item->tingkatan }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="font-bold text-lg {{ $item->rata_rata >= 75 ? 'text-green-400' : 'text-yellow-400' }}">
                            {{ $item->rata_rata }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if($item->rata_rata >= 75)
                            <span class="px-2 py-1 rounded text-xs font-semibold bg-green-500/20 text-green-300">LULUS</span>
                        @else
                            <span class="px-2 py-1 rounded text-xs font-semibold bg-red-500/20 text-red-300">TIDAK LULUS</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-400 text-sm">{{ $item->petugas }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('penilaian.show', $item) }}" class="p-2 rounded-lg bg-white/10 hover:bg-white/20 text-white transition" title="Lihat Detail">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                            <form action="{{ route('penilaian.destroy', $item) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus penilaian ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-lg bg-red-500/20 hover:bg-red-500/30 text-red-300 transition" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                        Belum ada data penilaian. Mulai penilaian baru dengan klik tombol di atas.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>
        @if($penilaian->hasPages())
        <div class="p-4 border-t border-white/5">
            {{ $penilaian->links() }}
        </div>
        @endif
    </div>
</x-app-layout>
