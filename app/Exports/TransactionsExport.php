<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class TransactionsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $transactions;

    public function __construct(Collection $transactions)
    {
        $this->transactions = $transactions;
    }

    public function collection()
    {
        return $this->transactions;
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Tipe',
            'Kategori',
            'Dompet',
            'Jumlah',
            'Catatan'
        ];
    }

    public function map($transaction): array
    {
        return [
            \Carbon\Carbon::parse($transaction->date)->format('d/m/Y'),
            $transaction->type == 'income' ? 'Pemasukan' : 'Pengeluaran',
            $transaction->category->name ?? '-',
            $transaction->wallet->name ?? '-',
            $transaction->amount,
            $transaction->name,
        ];
    }
}
