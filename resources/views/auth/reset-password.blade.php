<x-guest-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="text-center">
            <h2 class="text-3xl font-bold bg-gradient-to-r from-[#001d3d] to-[#003566] bg-clip-text text-transparent">
                Reset Password
            </h2>
            <p class="mt-2 text-gray-600 text-lg">
                Buat password baru untuk akun Anda
            </p>
        </div>

        <!-- Security Info -->
        <div class="bg-gradient-to-r from-[#ffd60a]/10 to-[#ffc300]/10 rounded-xl p-4 border border-[#ffd60a]/20">
            <div class="flex items-start space-x-3">
                <svg class="w-5 h-5 text-[#003566] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                <p class="text-sm text-gray-600">
                    Masukkan email dan buat password baru yang kuat untuk akun MEND Anda.
                </p>
            </div>
        </div>

        <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                        :value="old('email', $request->email)" 
                        required 
                        autofocus 
                        autocomplete="email"
                        placeholder="email@example.com" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="space-y-2">
                <x-input-label for="password" :value="__('Password Baru')" class="text-gray-700 font-semibold text-sm" />
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
                        placeholder="Buat password baru yang kuat" />
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
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password Baru')" class="text-gray-700 font-semibold text-sm" />
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
                        placeholder="Ketik ulang password baru" />
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Password Tips -->
            <div class="bg-blue-50 rounded-xl p-4 border border-blue-100">
                <h4 class="font-semibold text-[#003566] text-sm mb-2 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Tips Password yang Kuat:
                </h4>
                <ul class="space-y-1 text-xs text-gray-600">
                    <li class="flex items-center space-x-2">
                        <div class="w-1 h-1 bg-blue-400 rounded-full"></div>
                        <span>Gunakan kombinasi huruf besar & kecil</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <div class="w-1 h-1 bg-blue-400 rounded-full"></div>
                        <span>Sertakan angka dan simbol</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <div class="w-1 h-1 bg-blue-400 rounded-full"></div>
                        <span>Minimal 8 karakter</span>
                    </li>
                </ul>
            </div>

            <!-- Reset Button -->
            <div class="pt-2">
                <x-primary-button class="w-full flex justify-center items-center gap-3 py-4 px-4 border border-transparent rounded-xl shadow-lg text-base font-bold text-white bg-gradient-to-r from-[#003566] to-[#001d3d] hover:from-[#001d3d] hover:to-[#000814] focus:outline-none focus:ring-4 focus:ring-[#003566]/30 transform hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 group">
                    <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    <span>Reset Password</span>
                </x-primary-button>
            </div>

            <!-- Security Note -->
            <div class="text-center pt-4 border-t border-gray-200">
                <div class="inline-flex items-center gap-2 text-xs text-gray-500 bg-gray-100 px-3 py-2 rounded-full">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    <span>Password Anda akan segera diperbarui</span>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>