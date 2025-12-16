<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>MEND - Financial Command</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=jetbrains-mono:400,500|plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --deep-space: #000814;
                --midnight-blue: #001d3d;
                --ocean-blue: #003566;
                --vibrant-yellow: #ffc300;
                --sun-yellow: #ffd60a;
                --black: #000000;
                --white: #ffffff;
            }
            
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
                background-color: var(--white);
                color: var(--black);
                min-height: 100vh;
                overflow-x: hidden;
            }
            
            .font-mono { 
                font-family: 'JetBrains Mono', monospace; 
            }
            
            .container {
                display: flex;
                min-height: 100vh;
            }
            
            /* Left Panel - Visual Area */
            .visual-panel {
                flex: 1;
                background: linear-gradient(135deg, var(--midnight-blue) 0%, var(--ocean-blue) 100%);
                position: relative;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                padding: 3rem;
            }
            
            .visual-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: 
                    radial-gradient(circle at 20% 80%, rgba(255, 195, 0, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 80% 20%, rgba(255, 214, 10, 0.08) 0%, transparent 50%),
                    repeating-linear-gradient(45deg, transparent, transparent 5px, rgba(255, 214, 10, 0.03) 5px, rgba(255, 214, 10, 0.03) 10px);
            }
            
            .logo {
                display: flex;
                align-items: center;
                gap: 12px;
                z-index: 10;
                position: relative;
            }
            
            .logo-icon {
                width: 42px;
                height: 42px;
                background: var(--vibrant-yellow);
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 800;
                color: var(--midnight-blue);
                box-shadow: 0 4px 12px rgba(255, 195, 0, 0.3);
            }
            
            .logo-text {
                font-size: 1.5rem;
                font-weight: 700;
                letter-spacing: -0.5px;
                color: var(--white);
            }
            
            .logo-text span {
                color: var(--vibrant-yellow);
            }
            
            .hero-content {
                z-index: 10;
                position: relative;
                max-width: 600px;
            }
            
            .hero-title {
                font-size: 3.5rem;
                font-weight: 800;
                line-height: 1.1;
                margin-bottom: 1.5rem;
                background: linear-gradient(to right, var(--white) 0%, var(--sun-yellow) 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
                line-height: 1.6;
                color: rgba(255, 255, 255, 0.8);
                margin-bottom: 2rem;
                max-width: 500px;
                border-left: 4px solid var(--vibrant-yellow);
                padding-left: 1.5rem;
            }
            
            .stats-container {
                display: flex;
                gap: 1.5rem;
                z-index: 10;
                position: relative;
            }
            
            .stat-card {
                background: rgba(0, 29, 61, 0.6);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 214, 10, 0.1);
                border-radius: 12px;
                padding: 1.5rem;
                width: 180px;
            }
            
            .stat-value {
                font-size: 2rem;
                font-weight: 700;
                color: var(--sun-yellow);
                margin-bottom: 0.5rem;
            }
            
            .stat-label {
                font-size: 0.85rem;
                color: rgba(255, 255, 255, 0.7);
                text-transform: uppercase;
                letter-spacing: 1px;
            }
            
            /* Right Panel - Login Form */
            .login-panel {
                width: 480px;
                background: var(--white);
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: 3rem;
                position: relative;
            }
            
            .mobile-logo {
                display: none;
                align-items: center;
                gap: 8px;
                position: absolute;
                top: 2rem;
                left: 2rem;
            }
            
            .mobile-logo-icon {
                width: 32px;
                height: 32px;
                background: var(--midnight-blue);
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 700;
                color: var(--vibrant-yellow);
            }
            
            .mobile-logo-text {
                font-weight: 700;
                color: var(--midnight-blue);
            }
            
            .login-container {
                width: 100%;
                max-width: 360px;
                margin: 0 auto;
            }
            
            .login-header {
                margin-bottom: 2.5rem;
            }
            
            .login-title {
                font-size: 2rem;
                font-weight: 700;
                color: var(--midnight-blue);
                margin-bottom: 0.5rem;
            }
            
            .login-subtitle {
                color: var(--ocean-blue);
                font-size: 1rem;
            }
            
            .accent-line {
                width: 48px;
                height: 4px;
                background: var(--vibrant-yellow);
                margin-top: 1rem;
                border-radius: 2px;
            }
            
            .footer {
                margin-top: 2rem;
                text-align: center;
                font-size: 0.875rem;
                color: #6b7280;
            }
            
            /* Animations */
            @keyframes float {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-10px); }
            }
            
            .floating {
                animation: float 6s ease-in-out infinite;
            }
            
            /* Responsive Design */
            @media (max-width: 1024px) {
                .container {
                    flex-direction: column;
                }
                
                .login-panel {
                    width: 100%;
                    order: -1;
                    padding: 2rem;
                }
                
                .visual-panel {
                    padding: 2rem;
                }
                
                .hero-title {
                    font-size: 2.5rem;
                }
                
                .stats-container {
                    justify-content: center;
                }
                
                .mobile-logo {
                    display: flex;
                }
            }
            
            @media (max-width: 640px) {
                .hero-title {
                    font-size: 2rem;
                }
                
                .stats-container {
                    flex-direction: column;
                    align-items: center;
                }
                
                .stat-card {
                    width: 100%;
                    max-width: 250px;
                }
                
                .login-panel {
                    padding: 1.5rem;
                }
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="container">
            <!-- Left Visual Panel -->
            <div class="visual-panel">
                <div class="visual-overlay"></div>
                
                <div class="logo">
                    <div class="logo-icon">M</div>
                    <div class="logo-text">MEND<span>.Financial</span></div>
                </div>
                
                <div class="hero-content">
                    <h1 class="hero-title">
                        Mulai Effort <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#ffd500] to-[#fdc500]">
                            Ngatur Duit
                        </span>
                    </h1>
                    <p class="hero-subtitle">
                        Sistem manajemen keuangan untuk memantau pemasukan dan pengeluaran Anda.
                        <br><span class="text-sm font-mono mt-2 block opacity-70">// Start your effort now.</span>
                    </p>
                    
                    <div class="stats-container">
                        <div class="stat-card floating" style="animation-delay: 0s;">
                            <div class="stat-value">98%</div>
                            <div class="stat-label">Efficiency</div>
                        </div>
                        <div class="stat-card floating" style="animation-delay: 1s;">
                            <div class="stat-value">2+</div>
                            <div class="stat-label">Users</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Login Panel -->
            <div class="login-panel">
                <div class="mobile-logo">
                    <div class="mobile-logo-icon">M</div>
                    <div class="mobile-logo-text">MEND.</div>
                </div>
                
                <div class="login-container">
                    <div class="login-header">
                        <h2 class="login-title">Welcome Back!</h2>
                        <p class="login-subtitle">Silakan masuk untuk mengatur keuanganmu.</p>
                        <div class="accent-line"></div>
                    </div>

                    {{ $slot }}

                    <div class="footer">
                        &copy; {{ date('Y') }} MEND Financial System.
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>