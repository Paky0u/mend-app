<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dompet Bawaan
    \App\Models\Wallet::insert([
        ['name' => 'Tunai / Cash', 'is_active' => true],
        ['name' => 'Bank BCA', 'is_active' => true],
        ['name' => 'OVO', 'is_active' => true],
    ]);
    
    // Kategori Bawaan
    \App\Models\Category::insert([
        ['name' => 'Gaji', 'type' => 'income', 'user_id' => null],
        ['name' => 'Makan & Minum', 'type' => 'expense', 'user_id' => null],
        ['name' => 'Transportasi', 'type' => 'expense', 'user_id' => null],
    ]);
    }
}
