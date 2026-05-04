<x-app-layout>
    <h2 class="page-title">Laporan Keuangan</h2>

    <form action="{{ route('laporan') }}" method="GET" class="filter-card">
        <div class="filter-group">
            <label>Dari Tanggal</label>
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="filter-input">
        </div>
        <div class="filter-group">
            <label>Sampai Tanggal</label>
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="filter-input">
        </div>
        <button type="submit" class="btn-filter">Tampilkan</button>
        <a href="{{ route('laporan') }}" class="btn-reset">Reset</a>
        <a href="{{ route('laporan.export', request()->query()) }}" class="btn-filter" style="background-color: #10b981; border-color: #10b981; text-decoration: none; display: inline-flex; align-items: center;">📥 Export Excel</a>
    </form>

    @if($transactions->count() > 0)
    
    <div class="report-grid">
        <div class="chart-card">
            <h3 style="margin-bottom: 20px; font-size: 16px; color: #334155; text-align:center;">Pemasukan vs Pengeluaran</h3>
            <div class="chart-canvas-wrapper">
                <canvas id="mainChart"></canvas>
            </div>
        </div>

        <div class="summary-card">
            <div class="card" style="border-left: 5px solid #16a34a;">
                <div class="card-title">Total Pemasukan</div>
                <div class="card-amount text-green">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
            </div>
            <div class="card" style="border-left: 5px solid #dc2626;">
                <div class="card-title">Total Pengeluaran</div>
                <div class="card-amount text-red">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
            </div>
            <div class="card" style="border-left: 5px solid #2563eb;">
                <div class="card-title">Selisih</div>
                <div class="card-amount text-blue">Rp {{ number_format($totalPemasukan - $totalPengeluaran, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    <div class="report-grid">
        <div class="chart-card">
            <h3 style="margin-bottom: 20px; font-size: 16px; color: #334155; text-align:center;">Detail Pemasukan per Kategori</h3>
            <div class="chart-canvas-wrapper">
                <canvas id="incomeChart"></canvas>
            </div>
        </div>

        <div class="chart-card">
            <h3 style="margin-bottom: 20px; font-size: 16px; color: #334155; text-align:center;">Detail Pengeluaran per Kategori</h3>
            <div class="chart-canvas-wrapper">
                <canvas id="expenseChart"></canvas>
            </div>
        </div>
    </div>

    @endif

    <div class="table-container">
        <h3 style="margin-bottom: 15px; font-size: 18px; color: #334155;">Rincian Transaksi</h3>
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Tipe</th>
                    <th>Kategori</th>
                    <th>Dompet</th>
                    <th>Catatan</th>
                    <th style="text-align: right;">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $t)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($t->date)->format('d/m/Y') }}</td>
                    <td>
                        <span class="badge {{ $t->type == 'income' ? 'badge-income' : 'badge-expense' }}">
                            {{ $t->type == 'income' ? 'Masuk' : 'Keluar' }}
                        </span>
                    </td>
                    <td style="font-weight: bold; color: #475569;">{{ $t->category->name ?? '-' }}</td>
                    <td style="color: #64748b;">{{ $t->wallet->name ?? '-' }}</td>
                    <td>{{ $t->name }}</td>
                    <td style="text-align: right; font-family: monospace;">Rp {{ number_format($t->amount, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align: center; padding: 40px; color: #94a3b8;">Tidak ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // 1. Grafik Utama (Income vs Expense)
        const ctxMain = document.getElementById('mainChart');
        if (ctxMain) {
            new Chart(ctxMain, {
                type: 'doughnut',
                data: {
                    labels: ['Pemasukan', 'Pengeluaran'],
                    datasets: [{
                        data: [{{ $totalPemasukan }}, {{ $totalPengeluaran }}],
                        backgroundColor: ['#16a34a', '#dc2626'],
                        hoverOffset: 4
                    }]
                },
                options: { maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
            });
        }

        // 2. Grafik Kategori Pemasukan
        const ctxIncome = document.getElementById('incomeChart');
        if (ctxIncome) {
            new Chart(ctxIncome, {
                type: 'pie',
                data: {
                    // Ambil nama kategori (Keys)
                    labels: {!! json_encode($incomePie->keys()) !!},
                    datasets: [{
                        // Ambil jumlah uang (Values)
                        data: {!! json_encode($incomePie->values()) !!},
                        backgroundColor: ['#4ade80', '#22c55e', '#16a34a', '#15803d', '#166534'], // Variasi Hijau
                        hoverOffset: 4
                    }]
                },
                options: { maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
            });
        }

        // 3. Grafik Kategori Pengeluaran
        const ctxExpense = document.getElementById('expenseChart');
        if (ctxExpense) {
            new Chart(ctxExpense, {
                type: 'pie',
                data: {
                    labels: {!! json_encode($expensePie->keys()) !!},
                    datasets: [{
                        data: {!! json_encode($expensePie->values()) !!},
                        backgroundColor: ['#f87171', '#ef4444', '#dc2626', '#b91c1c', '#991b1b'], // Variasi Merah
                        hoverOffset: 4
                    }]
                },
                options: { maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
            });
        }
    </script>
</x-app-layout>