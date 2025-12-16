<x-app-layout>
    <h2 class="page-title">Edit Kategori</h2>

    <div class="form-card">
        <div class="form-header">Edit Data Kategori</div>
        
        <form action="{{ route('category.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT') <div class="form-group" style="margin-bottom: 15px;">
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="name" value="{{ $category->name }}" class="form-input" required>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label class="form-label">Tipe</label>
                <select name="type" class="form-input" required>
                    <option value="income" {{ $category->type == 'income' ? 'selected' : '' }}>Pemasukan</option>
                    <option value="expense" {{ $category->type == 'expense' ? 'selected' : '' }}>Pengeluaran</option>
                </select>
            </div>

            <button type="submit" class="btn-submit" style="background-color: #f59e0b;">Update</button>
            <a href="{{ route('category.index') }}" class="btn-submit" style="background-color: #64748b; text-decoration: none; display: inline-flex; align-items: center;">Batal</a>
        </form>
    </div>
</x-app-layout>