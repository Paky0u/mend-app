<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    // UPDATE DI SINI:
    // Kita tambahkan 'user_id' dan 'initial_balance' ke dalam fillable
    // agar Laravel mengizinkan kita menyimpan data ke kolom tersebut.
    protected $fillable = [
        'user_id', 
        'name', 
        'initial_balance', 
        'is_active'
    ];

    // (Opsional tapi Bagus) Definisikan relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}