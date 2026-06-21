<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'MEND App') }}</title>
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <div class="app-wrapper">
        
        <aside class="sidebar">
            <div class="sidebar-header" style="flex-direction: column; justify-content: center; gap: 5px;">
                <h1 style="font-size: 28px; color: #60a5fa;">MEND</h1>
                <span style="font-size: 10px; color: #94a3b8; letter-spacing: 1px;">Mulai Effort Ngatur Duit</span>
            </div>
            
            <nav class="sidebar-menu">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>
                
                <a href="{{ route('pemasukan') }}" class="{{ request()->routeIs('pemasukan') ? 'active' : '' }}">
                    Uang Masuk
                </a>
                <a href="{{ route('pengeluaran') }}" class="{{ request()->routeIs('pengeluaran') ? 'active' : '' }}">
                    Uang Keluar
                </a>

                <a href="{{ route('category.index') }}" class="{{ request()->routeIs('category.index') ? 'active' : '' }}">
                    Kelola Kategori
                </a>
                <a href="{{ route('wallet.index') }}" class="{{ request()->routeIs('wallet.index') ? 'active' : '' }}">
                    Kelola Dompet
                </a>

                <a href="{{ route('laporan') }}" class="{{ request()->routeIs('laporan') ? 'active' : '' }}">
                    Laporan
                </a>
                
                <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                    Profil Saya
                </a>
                
                @if(!Auth::user()->is_premium)
                <a href="{{ route('premium.index') }}" class="{{ request()->routeIs('premium.index') ? 'active' : '' }}" style="color: #fbbf24; font-weight: bold; margin-top: 15px;">
                    ⭐ Upgrade Premium
                </a>
                @else
                <span style="display: block; padding: 10px 15px; color: #fbbf24; font-weight: bold; font-size: 14px; margin-top: 15px;">
                    ⭐ Akun Premium
                </span>
                @endif
            </nav>

            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn">Keluar</button>
            </form>
        </aside>

        <main class="main-content">
            <div class="header-bar">
                <div class="user-info">
                    Halo, <b>{{ Auth::user()->name }}</b>
                </div>
            </div>

            @if(session('success'))
                <div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #bbf7d0;">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #fecaca;">
                    {{ session('error') }}
                </div>
            @endif

            @if(!Auth::user()->is_premium)
                <div class="ad-banner" style="margin-bottom: 25px; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); position: relative; border: 1px solid #e2e8f0; background: #fff;">
                    <div style="position: absolute; top: 10px; left: 10px; background: rgba(0,0,0,0.6); color: white; font-size: 10px; padding: 3px 8px; border-radius: 4px; font-weight: bold; text-transform: uppercase;">Ad / Sponsor</div>
                    
                    <a href="{{ route('premium.index') }}" style="position: absolute; top: 10px; right: 10px; background: rgba(255, 255, 255, 0.95); color: #3b82f6; font-size: 11px; padding: 6px 12px; border-radius: 20px; font-weight: bold; text-decoration: none; box-shadow: 0 2px 4px rgba(0,0,0,0.1); display: flex; align-items: center; gap: 5px; transition: 0.2s;">
                        ✨ Hilangkan Iklan
                    </a>

                    <!-- Gambar Iklan Lebar -->
                    <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=1200&h=250&q=80" alt="Iklan Banner" style="width: 100%; height: 180px; object-fit: cover; display: block;">
                    
                    <div style="padding: 15px 20px; display: flex; justify-content: space-between; align-items: center;">
                        <div style="padding-right: 15px;">
                            <h3 style="margin: 0 0 5px 0; font-size: 16px; font-weight: bold; color: #1e293b;">Dapatkan Cashback 50% untuk Transaksi Pertamamu!</h3>
                            <p style="margin: 0; font-size: 13px; color: #64748b;">Promo khusus untuk pengguna baru. Daftar sekarang dan nikmati keuntungannya.</p>
                        </div>
                        <a href="#" style="background: #10b981; color: white; padding: 10px 24px; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: bold; white-space: nowrap;">Klaim Promo</a>
                    </div>
                </div>
            @endif

            {{ $slot ?? '' }}
        </main>

    </div>

</body>
</html>