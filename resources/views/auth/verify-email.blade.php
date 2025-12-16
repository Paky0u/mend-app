<x-guest-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="text-center">
            <h2 class="text-3xl font-bold bg-gradient-to-r from-[#001d3d] to-[#003566] bg-clip-text text-transparent">
                Verifikasi Email
            </h2>
            <p class="mt-2 text-gray-600 text-lg">
                Selangkah lagi untuk memulai perjalanan finansial Anda
            </p>
        </div>

        <!-- Info Box -->
        <div class="bg-gradient-to-r from-[#ffd60a]/10 to-[#ffc300]/10 rounded-xl p-4 border border-[#ffd60a]/20">
            <div class="flex items-start space-x-3">
                <svg class="w-5 h-5 text-[#003566] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <div>
                    <p class="text-sm text-gray-600 mb-3">
                        {{ __('Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik link yang baru saja kami kirim ke email Anda. Jika Anda tidak menerima email, kami dengan senang hati akan mengirimkan yang lain.') }}
                    </p>
                    
                    <!-- Success Message -->
                    @if (session('status') == 'verification-link-sent')
                        <div class="flex items-center space-x-2 text-sm text-green-600 bg-green-50 px-3 py-2 rounded-lg border border-green-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ __('Link verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Email Illustration -->
        <div class="flex justify-center">
            <div class="relative">
                <div class="w-20 h-20 bg-gradient-to-br from-[#003566] to-[#001d3d] rounded-2xl flex items-center justify-center">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="absolute -top-2 -right-2 w-6 h-6 bg-[#ffc300] rounded-full flex items-center justify-center">
                    <svg class="w-3 h-3 text-[#001d3d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-between items-center pt-4">
            <!-- Resend Verification Form -->
            <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
                @csrf
                <x-primary-button class="w-full sm:w-auto flex justify-center items-center gap-3 py-3 px-6 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-gradient-to-r from-[#003566] to-[#001d3d] hover:from-[#001d3d] hover:to-[#000814] focus:outline-none focus:ring-4 focus:ring-[#003566]/30 transform hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 group">
                    <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span>{{ __('Kirim Ulang Email Verifikasi') }}</span>
                </x-primary-button>
            </form>

            <!-- Logout Form -->
            <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                @csrf
                <button type="submit" class="w-full sm:w-auto flex justify-center items-center gap-2 py-3 px-6 text-sm font-semibold text-gray-600 hover:text-gray-800 rounded-xl border border-gray-300 hover:border-gray-400 transition-all duration-200 hover:bg-gray-50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span>{{ __('Log Out') }}</span>
                </button>
            </form>
        </div>

        <!-- Help Tips -->
        <div class="bg-blue-50 rounded-xl p-4 border border-blue-100 mt-6">
            <h4 class="font-semibold text-[#003566] text-sm mb-2 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Tips:
            </h4>
            <ul class="space-y-2 text-xs text-gray-600">
                <li class="flex items-center space-x-2">
                    <div class="w-1 h-1 bg-blue-400 rounded-full"></div>
                    <span>Periksa folder <strong>Spam</strong> atau <strong>Promosi</strong> di email Anda</span>
                </li>
                <li class="flex items-center space-x-2">
                    <div class="w-1 h-1 bg-blue-400 rounded-full"></div>
                    <span>Pastikan email yang Anda daftarkan sudah benar</span>
                </li>
                <li class="flex items-center space-x-2">
                    <div class="w-1 h-1 bg-blue-400 rounded-full"></div>
                    <span>Link verifikasi akan kadaluarsa dalam 24 jam</span>
                </li>
            </ul>
        </div>

        <!-- Security Note -->
        <div class="text-center pt-4 border-t border-gray-200">
            <div class="inline-flex items-center gap-2 text-xs text-gray-500 bg-gray-100 px-3 py-2 rounded-full">
                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                <span>Verifikasi email untuk keamanan akun Anda</span>
            </div>
        </div>
    </div>
</x-guest-layout>