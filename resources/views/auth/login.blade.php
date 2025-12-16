<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="space-y-6">
        <!-- Header -->
        <div class="text-center">
            <h2 class="text-3xl font-bold bg-gradient-to-r from-[#001d3d] to-[#003566] bg-clip-text text-transparent">
                Yuk, Masuk MEND!
            </h2>
            <p class="mt-2 text-gray-600 text-lg">
                Kelola duit lebih mudah dan teratur
            </p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div class="space-y-2">
                <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 font-semibold text-sm" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                        </svg>
                    </div>
                    <x-text-input 
                        id="email" 
                        class="block mt-1 w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#003566] focus:border-transparent transition-all duration-300 bg-white/80" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required 
                        autofocus 
                        autocomplete="username"
                        placeholder="email@example.com" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="space-y-2">
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold text-sm" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <x-text-input 
                        id="password" 
                        class="block mt-1 w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#003566] focus:border-transparent transition-all duration-300 bg-white/80"
                        type="password"
                        name="password"
                        required 
                        autocomplete="current-password"
                        placeholder="masukkan password" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <div class="relative">
                        <input 
                            id="remember_me" 
                            type="checkbox" 
                            class="sr-only peer" 
                            name="remember">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#003566] rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#003566]"></div>
                    </div>
                    <span class="ms-3 text-sm text-gray-600 font-medium">Ingat saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm font-semibold text-[#003566] hover:text-[#001d3d] transition-colors duration-200 hover:underline" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>

            <!-- Login Button -->
            <div class="pt-2">
                <x-primary-button class="w-full flex justify-center items-center gap-3 py-4 px-4 border border-transparent rounded-xl shadow-lg text-base font-bold text-white bg-gradient-to-r from-[#003566] to-[#001d3d] hover:from-[#001d3d] hover:to-[#000814] focus:outline-none focus:ring-4 focus:ring-[#003566]/30 transform hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 group">
                    <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    <span>Masuk ke MEND</span>
                </x-primary-button>
            </div>

            <!-- Register Link -->
            @if (Route::has('register'))
                <div class="text-center pt-4 border-t border-gray-200">
                    <p class="text-gray-600 text-sm">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="font-semibold text-[#003566] hover:text-[#001d3d] transition-colors duration-200 hover:underline ml-1">
                            Daftar sekarang
                        </a>
                    </p>
                    <p class="text-gray-500 text-xs mt-2">
                        Gratis! Yuk mulai atur duit dengan lebih baik
                    </p>
                </div>
            @endif
        </form>
    </div>
</x-guest-layout>