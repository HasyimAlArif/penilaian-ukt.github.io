<x-app-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Tambah Petugas</h1>
        <p class="text-gray-400">Tambahkan pengguna baru ke sistem</p>
    </div>

    <div class="glass-card rounded-xl p-8 max-w-2xl">
        <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm text-gray-300 mb-2">Nama Lengkap</label>
                <input id="name" class="input-field w-full px-4 py-3 rounded-lg text-white" 
                       type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Contoh: Budi Santoso">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm text-gray-300 mb-2">Email Address</label>
                <input id="email" class="input-field w-full px-4 py-3 rounded-lg text-white" 
                       type="email" name="email" value="{{ old('email') }}" required placeholder="contoh@pagarnusa.or.id">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Role -->
            <div>
                <label for="role" class="block text-sm text-gray-300 mb-2">Role</label>
                <select id="role" name="role" class="input-field w-full px-4 py-3 rounded-lg text-white appearance-none">
                    <option value="petugas" class="bg-gray-800" {{ old('role') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                    <option value="admin" class="bg-gray-800" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm text-gray-300 mb-2">Password</label>
                <input id="password" class="input-field w-full px-4 py-3 rounded-lg text-white" 
                       type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end gap-4 pt-4">
                <a href="{{ route('users.index') }}" class="px-4 py-2 rounded-lg bg-white/5 hover:bg-white/10 text-gray-300 transition">
                    Batal
                </a>
                <button type="submit" class="btn-primary px-6 py-2 rounded-lg text-white font-medium">
                    Simpan Petugas
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
