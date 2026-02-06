<x-app-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Edit Soal</h1>
        <p class="text-gray-400">Edit data soal</p>
    </div>

    <div class="glass-card rounded-xl p-8 max-w-2xl">
        <form method="POST" action="{{ route('soal.update', $soal) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Tingkatan -->
            <div>
                <label for="tingkatan" class="block text-sm text-gray-300 mb-2">Tingkatan Sabuk</label>
                <select id="tingkatan" name="tingkatan" class="input-field w-full px-4 py-3 rounded-lg text-white appearance-none">
                    <option value="Putih" class="bg-gray-800" {{ old('tingkatan', $soal->tingkatan) == 'Putih' ? 'selected' : '' }}>Putih</option>
                    <option value="Kuning" class="bg-gray-800" {{ old('tingkatan', $soal->tingkatan) == 'Kuning' ? 'selected' : '' }}>Kuning</option>
                    <option value="Merah" class="bg-gray-800" {{ old('tingkatan', $soal->tingkatan) == 'Merah' ? 'selected' : '' }}>Merah</option>
                    <option value="Biru" class="bg-gray-800" {{ old('tingkatan', $soal->tingkatan) == 'Biru' ? 'selected' : '' }}>Biru</option>
                    <option value="Coklat" class="bg-gray-800" {{ old('tingkatan', $soal->tingkatan) == 'Coklat' ? 'selected' : '' }}>Coklat</option>
                    <option value="Hitam" class="bg-gray-800" {{ old('tingkatan', $soal->tingkatan) == 'Hitam' ? 'selected' : '' }}>Hitam</option>
                </select>
                <x-input-error :messages="$errors->get('tingkatan')" class="mt-2" />
            </div>

            <!-- Kategori -->
            <div>
                <label for="kategori" class="block text-sm text-gray-300 mb-2">Kategori Materi</label>
                <select id="kategori" name="kategori" class="input-field w-full px-4 py-3 rounded-lg text-white appearance-none">
                    @foreach(['SALAM PAGAR NUSA', 'TEKNIK DASAR PUKULAN', 'TEKNIK DASAR TANGKISAN', 'TEKNIK DASAR TENDANGAN', 'TEKNIK DASAR PAGAR NUSA', 'FISIK', 'TEKNIK SERANG BALAS', 'JURUS WAJIB IPSI'] as $cat)
                        <option value="{{ $cat }}" class="bg-gray-800" {{ old('kategori', $soal->kategori) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
            </div>

            <!-- Soal -->
            <div>
                <label for="soal" class="block text-sm text-gray-300 mb-2">Isi Soal</label>
                <textarea id="soal" name="soal" rows="4" class="input-field w-full px-4 py-3 rounded-lg text-white" required>{{ old('soal', $soal->soal) }}</textarea>
                <x-input-error :messages="$errors->get('soal')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end gap-4 pt-4">
                <a href="{{ route('soal.index') }}" class="px-4 py-2 rounded-lg bg-white/5 hover:bg-white/10 text-gray-300 transition">
                    Batal
                </a>
                <button type="submit" class="btn-primary px-6 py-2 rounded-lg text-white font-medium">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
