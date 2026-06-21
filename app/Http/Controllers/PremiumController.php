<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Illuminate\Support\Facades\Log;

class PremiumController extends Controller
{
    public function __construct()
    {
        // Set konfigurasi midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function index()
    {
        return view('premium.index');
    }

    public function checkout(Request $request)
    {
        $user = auth()->user();

        // Jika user sudah premium
        if ($user->is_premium) {
            return redirect()->route('dashboard')->with('success', 'Anda sudah berlangganan premium.');
        }

        // Buat parameter transaksi
        $params = array(
            'transaction_details' => array(
                'order_id' => 'PREMIUM-' . $user->id . '-' . time(),
                'gross_amount' => 50000, // Harga premium (misal Rp 50.000)
            ),
            'customer_details' => array(
                'first_name' => $user->name,
                'email' => $user->email,
            ),
        );

        try {
            // Dapatkan Snap Token
            $snapToken = Snap::getSnapToken($params);
            
            // Kirim token ke view
            return view('premium.index', compact('snapToken'));
        } catch (\Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memproses pembayaran.');
        }
    }

    public function callback(Request $request)
    {
        try {
            $notification = new Notification();

            $transaction_status = $notification->transaction_status;
            $order_id = $notification->order_id;
            
            // Format order_id: PREMIUM-{user_id}-{timestamp}
            $parts = explode('-', $order_id);
            if (count($parts) >= 2 && $parts[0] === 'PREMIUM') {
                $userId = $parts[1];
                $user = \App\Models\User::find($userId);

                if ($user) {
                    if ($transaction_status == 'capture' || $transaction_status == 'settlement') {
                        // Pembayaran sukses
                        $user->is_premium = true;
                        $user->save();
                        Log::info("User ID {$userId} upgraded to Premium via Midtrans.");
                    } else if ($transaction_status == 'cancel' || $transaction_status == 'deny' || $transaction_status == 'expire') {
                        // Pembayaran gagal atau kadaluarsa
                        Log::info("Payment failed/expired for User ID {$userId}. Status: {$transaction_status}");
                    }
                }
            }

            return response()->json(['message' => 'Callback handled successfully']);
        } catch (\Exception $e) {
            Log::error('Midtrans Callback Error: ' . $e->getMessage());
            return response()->json(['message' => 'Error processing callback'], 500);
        }
    }
    public function cancel(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $user->is_premium = false;
            $user->save();
        }
        
        return redirect()->route('dashboard')->with('success', 'Status Premium telah dibatalkan (Mode Demo). Iklan akan muncul kembali.');
    }

    // Hanya digunakan untuk localhost / presentasi (Bypass Webhook)
    public function success(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $user->is_premium = true;
            $user->save();
        }
        return response()->json(['success' => true]);
    }
}
