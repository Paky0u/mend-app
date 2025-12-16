<x-guest-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="text-center">
            <h2 class="text-3xl font-bold bg-gradient-to-r from-[#001d3d] to-[#003566] bg-clip-text text-transparent">
                Yuk, Daftar MEND!
            </h2>
            <p class="mt-2 text-gray-600 text-lg">
                Mulai journey ngatur duit yang lebih baik
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Name -->
            <div class="space-y-2">
                <x-input-label for="name" :value="__('Nama Lengkap')" class="text-gray-700 font-semibold text-sm" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <x-text-input 
                        id="name" 
                        class="block mt-1 w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#003566] focus:border-transparent transition-all duration-300 bg-white/80" 
                        type="text" 
                        name="name" 
                        :value="old('name')" 
                        required 
                        autofocus 
                        autocomplete="name"
                        placeholder="Masukkan nama lengkap" />
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

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
                        autocomplete="email"
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
                        autocomplete="new-password"
                        placeholder="Buat password yang kuat" />
                </div>
                <div class="mt-2">
                    <div class="flex items-center space-x-2 text-xs text-gray-500">
                        <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                        <span>Minimal 8 karakter</span>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="space-y-2">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-gray-700 font-semibold text-sm" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <x-text-input 
                        id="password_confirmation" 
                        class="block mt-1 w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#003566] focus:border-transparent transition-all duration-300 bg-white/80"
                        type="password"
                        name="password_confirmation" 
                        required 
                        autocomplete="new-password"
                        placeholder="Ketik ulang password" />
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Benefits List -->
            <div class="bg-gradient-to-r from-[#ffd60a]/10 to-[#ffc300]/10 rounded-xl p-4 border border-[#ffd60a]/20">
                <h4 class="font-semibold text-[#001d3d] text-sm mb-2">Keuntungan bergabung dengan MEND:</h4>
                <ul class="space-y-2 text-xs text-gray-600">
                    <li class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-[#003566]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Pantau pemasukan dan pengeluaran dengan mudah</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-[#003566]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Analisis keuangan dengan grafik interaktif</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-[#003566]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Set target tabungan dan pengeluaran</span>
                    </li>
                </ul>
            </div>

            <!-- Submit Button & Login Link -->
            <div class="flex items-center justify-between pt-4">
                <a class="text-sm font-semibold text-[#003566] hover:text-[#001d3d] transition-colors duration-200 hover:underline flex items-center space-x-1" href="{{ route('login') }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Sudah punya akun?</span>
                </a>

                <x-primary-button class="flex justify-center items-center gap-3 py-3 px-6 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-gradient-to-r from-[#003566] to-[#001d3d] hover:from-[#001d3d] hover:to-[#000814] focus:outline-none focus:ring-4 focus:ring-[#003566]/30 transform hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 group">
                    <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    <span>Daftar Sekarang</span>
                </x-primary-button>
            </div>

            <!-- Security Note -->
            <div class="text-center pt-4 border-t border-gray-200">
                <div class="inline-flex items-center gap-2 text-xs text-gray-500 bg-gray-100 px-3 py-2 rounded-full">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    <span>Data kamu aman dan terenkripsi</span>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>