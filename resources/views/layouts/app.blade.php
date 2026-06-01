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

            {{ $slot }}
        </main>

    </div>

</body>
</html>