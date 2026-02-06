<x-app-layout>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold">Kelola Soal</h1>
            <p class="text-gray-400">Daftar bank soal UKT</p>
        </div>
        <a href="{{ route('soal.create') }}" class="btn-primary px-4 py-2 rounded-lg text-white font-medium flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Soal
        </a>
    </div>

    <!-- Soal Table -->
    <div class="glass-card rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
        <table class="w-full text-left min-w-[600px]">
            <thead class="bg-white/5 uppercase text-xs text-gray-400">
                <tr>
                    <th class="px-6 py-4">Tingkatan</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Soal</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($soal as $item)
                <tr class="table-row">
                    <td class="px-6 py-4">
                        <span class="tingkatan-badge badge-{{ strtolower($item->tingkatan) }}">
                            {{ $item->tingkatan }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-300 font-medium">{{ $item->kategori }}</td>
                    <td class="px-6 py-4 text-gray-400 max-w-md truncate">{{ $item->soal }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('soal.edit', $item) }}" class="p-2 rounded-lg bg-blue-500/20 hover:bg-blue-500/30 text-blue-300 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <form action="{{ route('soal.destroy', $item) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus soal ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-lg bg-red-500/20 hover:bg-red-500/30 text-red-300 transition">
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
                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                        Belum ada data soal
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>
        @if($soal->hasPages())
        <div class="p-4 border-t border-white/5">
            {{ $soal->links() }}
        </div>
        @endif
    </div>
</x-app-layout>
