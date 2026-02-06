<x-guest-layout>
    <div class="glass-card rounded-2xl p-8 w-full max-w-md animate-fade-in">
        <div class="text-center mb-8">
            <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center shadow-lg shadow-red-500/30">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold mb-2">Sistem Penilaian UKT</h1>
            <p class="text-gray-400">Pagar Nusa</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm text-gray-300 mb-2">Email Address</label>
                <input id="email" class="input-field w-full px-4 py-3 rounded-lg text-white placeholder-gray-500" 
                       type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                       placeholder="admin@pagarnusa.or.id">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm text-gray-300 mb-2">Password</label>
                <input id="password" class="input-field w-full px-4 py-3 rounded-lg text-white placeholder-gray-500" 
                       type="password" name="password" required autocomplete="current-password"
                       placeholder="••••••••">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded bg-white/10 border-white/20 text-[#e94560] shadow-sm focus:ring-[#e94560]" name="remember">
                    <span class="ms-2 text-sm text-gray-300">{{ __('Remember me') }}</span>
                </label>
            </div>

            <button type="submit" class="btn-primary w-full py-3 rounded-lg font-semibold text-white mt-6">
                {{ __('Masuk') }}
            </button>
            
            <div class="text-center mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-400 hover:text-white" href="{{ route('password.request') }}">
                        {{ __('Lupa password?') }}
                    </a>
                @endif
            </div>
        </form>
        
        <p class="text-center text-gray-500 text-sm mt-6">
            Default Admin: admin@pagarnusa.or.id / admin123
        </p>
    </div>
</x-guest-layout>
