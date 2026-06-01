<x-app-layout>
    <h2 class="page-title">Pengaturan Profil</h2>

    @if (session('status') === 'profile-updated')
        <div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #bbf7d0;">
            <b>Sukses!</b> Informasi profil Anda berhasil diperbarui.
        </div>
    @endif

    @if (session('status') === 'password-updated')
        <div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #bbf7d0;">
            <b>Sukses!</b> Password Anda berhasil diperbarui.
        </div>
    @endif

    <div style="display: flex; gap: 30px; align-items: start; flex-wrap: wrap; margin-bottom: 30px;">
        
        <!-- KARTU UBAH PROFIL -->
        <div class="form-card" style="flex: 1; min-width: 320px;">
            <div class="form-header">Ubah Profil</div>
            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="form-group" style="margin-bottom: 15px;">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-input" value="{{ old('name', $user->name) }}" required autocomplete="name" placeholder="Nama Anda">
                    @if ($errors->has('name'))
                        <span style="color: #dc2626; font-size: 12px; margin-top: 5px; display: block;">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="form-label">Alamat Email</label>
                    <input type="email" name="email" class="form-input" value="{{ old('email', $user->email) }}" required autocomplete="email" placeholder="email@contoh.com">
                    @if ($errors->has('email'))
                        <span style="color: #dc2626; font-size: 12px; margin-top: 5px; display: block;">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn-submit" style="width: 100%;">Simpan Perubahan</button>
            </form>
        </div>

        <!-- KARTU UBAH PASSWORD -->
        <div class="form-card" style="flex: 1; min-width: 320px;">
            <div class="form-header">Ubah Password</div>
            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="form-group" style="margin-bottom: 15px;">
                    <label class="form-label">Password Saat Ini</label>
                    <input type="password" name="current_password" class="form-input" required autocomplete="current-password" placeholder="••••••••">
                    @if ($errors->updatePassword->has('current_password'))
                        <span style="color: #dc2626; font-size: 12px; margin-top: 5px; display: block;">{{ $errors->updatePassword->first('current_password') }}</span>
                    @endif
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="password" class="form-input" required autocomplete="new-password" placeholder="••••••••">
                    @if ($errors->updatePassword->has('password'))
                        <span style="color: #dc2626; font-size: 12px; margin-top: 5px; display: block;">{{ $errors->updatePassword->first('password') }}</span>
                    @endif
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-input" required autocomplete="new-password" placeholder="••••••••">
                    @if ($errors->updatePassword->has('password_confirmation'))
                        <span style="color: #dc2626; font-size: 12px; margin-top: 5px; display: block;">{{ $errors->updatePassword->first('password_confirmation') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn-submit" style="width: 100%;">Perbarui Password</button>
            </form>
        </div>

    </div>

    <!-- KARTU HAPUS AKUN -->
    <div class="form-card" style="border: 1px solid #fecaca; background-color: #fff5f5; max-width: 100%;">
        <div class="form-header" style="color: #dc2626; border-bottom: 1px solid #fee2e2;">Hapus Akun Permanen</div>
        <div style="display: flex; gap: 20px; align-items: start; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 300px;">
                <p style="font-size: 14px; color: #7f1d1d; line-height: 1.6; margin-bottom: 15px;">
                    Setelah akun Anda dihapus, semua data transaksi keuangan Anda (saldo dompet, riwayat pemasukan dan pengeluaran, kategori, dan laporan keuangan) akan <b>dihapus secara permanen</b> dari database MEND App.
                </p>
                <p style="font-size: 13px; color: #b91c1c; font-weight: bold; margin-bottom: 15px;">
                    *Tindakan ini tidak dapat dibatalkan atau dipulihkan kembali.
                </p>
            </div>
            
            <div style="flex: 1; min-width: 300px;">
                <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Apakah Anda benar-benar yakin ingin menghapus akun Anda secara permanen? Seluruh data transaksi, dompet, dan kategori Anda akan hilang selamanya.');">
                    @csrf
                    @method('delete')
                    
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label class="form-label" style="color: #7f1d1d;">Masukkan Password Anda Untuk Mengonfirmasi</label>
                        <input type="password" name="password" class="form-input" placeholder="Password akun saat ini" required style="border-color: #fca5a5;">
                        @if ($errors->userDeletion->has('password'))
                            <span style="color: #dc2626; font-size: 12px; margin-top: 5px; display: block;">{{ $errors->userDeletion->first('password') }}</span>
                        @endif
                    </div>
                    
                    <button type="submit" class="btn-submit" style="background-color: #dc2626; color: white; width: 100%; border: none;">
                        Hapus Akun Saya Selamanya
                    </button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
