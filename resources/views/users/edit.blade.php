<x-app-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Edit Petugas</h1>
        <p class="text-gray-400">Edit data pengguna {{ $user->name }}</p>
    </div>

    <div class="glass-card rounded-xl p-8 max-w-2xl">
        <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm text-gray-300 mb-2">Nama Lengkap</label>
                <input id="name" class="input-field w-full px-4 py-3 rounded-lg text-white" 
                       type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm text-gray-300 mb-2">Email Address</label>
                <input id="email" class="input-field w-full px-4 py-3 rounded-lg text-white" 
                       type="email" name="email" value="{{ old('email', $user->email) }}" required>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Role -->
            <div>
                <label for="role" class="block text-sm text-gray-300 mb-2">Role</label>
                <select id="role" name="role" class="input-field w-full px-4 py-3 rounded-lg text-white appearance-none">
                    <option value="petugas" class="bg-gray-800" {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>Petugas</option>
                    <option value="admin" class="bg-gray-800" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm text-gray-300 mb-2">Password (Opsional)</label>
                <input id="password" class="input-field w-full px-4 py-3 rounded-lg text-white" 
                       type="password" name="password" autocomplete="new-password" placeholder="Biarkan kosong jika tidak ingin mengubah password">
                <p class="text-xs text-gray-500 mt-1">Isi hanya jika ingin mereset password user ini.</p>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end gap-4 pt-4">
                <a href="{{ route('users.index') }}" class="px-4 py-2 rounded-lg bg-white/5 hover:bg-white/10 text-gray-300 transition">
                    Batal
                </a>
                <button type="submit" class="btn-primary px-6 py-2 rounded-lg text-white font-medium">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
