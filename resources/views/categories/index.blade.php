<x-app-layout>
    <h2 class="page-title">Kelola Kategori</h2>

    <div style="display: flex; gap: 30px; align-items: start; flex-wrap: wrap;">
        
        <div class="form-card" style="flex: 1; min-width: 300px;">
            <div class="form-header">Tambah Kategori Baru</div>
            <form action="{{ route('category.store') }}" method="POST">
                @csrf
                <div class="form-group" style="margin-bottom: 15px;">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="name" class="form-input" placeholder="Contoh: Kopi, Laundry" required>
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="form-label">Tipe</label>
                    <select name="type" class="form-input" required>
                        <option value="income">Pemasukan (Income)</option>
                        <option value="expense">Pengeluaran (Expense)</option>
                    </select>
                </div>

                <button type="submit" class="btn-submit" style="width: 100%;">Tambah</button>
            </form>
        </div>

        <div class="table-container" style="flex: 2; min-width: 300px;">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Tipe</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $index => $cat)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td style="font-weight: bold;">{{ $cat->name }}</td>
                        <td>
                            <span class="badge {{ $cat->type == 'income' ? 'badge-income' : 'badge-expense' }}">
                                {{ $cat->type == 'income' ? 'Pemasukan' : 'Pengeluaran' }}
                            </span>
                            @if(!$cat->user_id)
                                <span style="font-size:10px; color:#94a3b8; display:block;">(Umum)</span>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            @if($cat->user_id == Auth::id())
                                <a href="{{ route('category.edit', $cat->id) }}" class="action-btn btn-edit">Edit</a>
                                <form action="{{ route('category.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?');" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="action-btn btn-delete">Hapus</button>
                                </form>
                            @else
                                <span style="font-size: 20px; color: #cbd5e1;">🔒</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>