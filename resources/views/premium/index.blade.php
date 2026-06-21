<x-app-layout>
<div class="container mx-auto px-4 py-8 max-w-3xl" style="font-family: sans-serif; margin-top: 20px;">
    <div style="background: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden;">
        <div style="background: #2563eb; padding: 30px; text-align: center; color: white;">
            <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 10px;">Upgrade ke Premium</h1>
            <p style="color: #bfdbfe;">Nikmati pengalaman bebas iklan selamanya!</p>
        </div>
        
        <div style="padding: 30px; text-align: center;">
            @if(auth()->user()->is_premium)
                <div style="background: #dcfce7; color: #166534; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                    <h2 style="font-size: 20px; font-weight: bold;">Terima kasih!</h2>
                    <p>Akun Anda sudah Premium. Iklan tidak akan ditampilkan lagi.</p>
                </div>
                <a href="{{ route('dashboard') }}" style="display: inline-block; background: #4b5563; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none;">
                    Kembali ke Dashboard
                </a>
            @else
                <div style="margin-bottom: 30px;">
                    <div style="font-size: 36px; font-weight: bold; color: #1f2937; margin-bottom: 10px;">Rp 50.000</div>
                    <p style="color: #6b7280;">Sekali bayar, berlaku seumur hidup.</p>
                </div>

                <ul style="text-align: left; max-width: 300px; margin: 0 auto 30px; line-height: 2;">
                    <li>✔️ Bebas Iklan 100%</li>
                    <li>✔️ Dukungan Penuh</li>
                    <li>✔️ Akses Fitur Eksklusif Mendatang</li>
                </ul>

                @if(isset($snapToken))
                    <!-- Tombol untuk memunculkan popup Midtrans -->
                    <button id="pay-button" style="background: #2563eb; color: white; border: none; padding: 15px 30px; font-size: 16px; border-radius: 8px; cursor: pointer; font-weight: bold;">
                        Bayar Sekarang
                    </button>
                @else
                    <form action="{{ route('premium.checkout') }}" method="POST">
                        @csrf
                        <button type="submit" style="background: #2563eb; color: white; border: none; padding: 15px 30px; font-size: 16px; border-radius: 8px; cursor: pointer; font-weight: bold;">
                            Proses Pembayaran
                        </button>
                    </form>
                @endif
            @endif
        </div>
    </div>
</div>

@if(isset($snapToken))
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    // Karena webhook Midtrans tidak bisa masuk ke localhost,
                    // kita beritahu server secara manual lewat frontend bahwa pembayaran berhasil
                    fetch("{{ route('premium.success') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    }).then(() => {
                        alert("Pembayaran berhasil!"); 
                        window.location.href = "{{ route('dashboard') }}";
                    });
                },
                onPending: function(result){
                    alert("Menunggu pembayaran Anda!"); console.log(result);
                },
                onError: function(result){
                    alert("Pembayaran gagal!"); console.log(result);
                },
                onClose: function(){
                    alert('Anda menutup popup tanpa menyelesaikan pembayaran');
                }
            });
        };
    </script>
@endif
</x-app-layout>
