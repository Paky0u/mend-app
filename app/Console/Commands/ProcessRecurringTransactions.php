<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProcessRecurringTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-recurring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process recurring transactions and generate new ones automatically';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = \Carbon\Carbon::now()->format('Y-m-d');
        $transactions = \App\Models\Transaction::where('is_recurring', true)
                            ->whereNotNull('next_recurring_date')
                            ->where('next_recurring_date', '<=', $today)
                            ->get();

        $count = 0;
        foreach ($transactions as $t) {
            // Buat transaksi baru
            \App\Models\Transaction::create([
                'user_id' => $t->user_id,
                'category_id' => $t->category_id,
                'wallet_id' => $t->wallet_id,
                'name' => $t->name . ' (Otomatis)',
                'type' => $t->type,
                'amount' => $t->amount,
                'date' => $t->next_recurring_date,
                'attachment' => null, // Jangan salin attachment
                'is_recurring' => false, // Transaksi hasil tidak menjadi template
                'recurring_interval' => null,
                'next_recurring_date' => null,
            ]);

            // Hitung jadwal berikutnya
            $date = \Carbon\Carbon::parse($t->next_recurring_date);
            if ($t->recurring_interval == 'daily') {
                $next = $date->addDay()->format('Y-m-d');
            } elseif ($t->recurring_interval == 'weekly') {
                $next = $date->addWeek()->format('Y-m-d');
            } elseif ($t->recurring_interval == 'monthly') {
                $next = $date->addMonth()->format('Y-m-d');
            } elseif ($t->recurring_interval == 'yearly') {
                $next = $date->addYear()->format('Y-m-d');
            } else {
                $next = null;
            }

            // Update template
            $t->update(['next_recurring_date' => $next]);
            $count++;
        }

        $this->info("Processed $count recurring transactions.");
    }
}
