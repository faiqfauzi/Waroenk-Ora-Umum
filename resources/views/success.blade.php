@extends('layouts.app')

@section('title', 'Status Pembayaran')

@section('content')
<div style="text-align:center; padding: 40px 20px; max-width: 600px; margin:auto;">

    {{-- ===== QRIS SUCCESS VIEW ===== --}}
    @if ($order->method === 'qris')
        <div style="background-color: #4CAF50; padding: 20px; border-radius: 50%; display:inline-flex; justify-content:center; align-items:center; margin-bottom: 20px;">
            <span style="font-size: 50px; color:white;">✓</span>
        </div>

        <h1 style="font-size: 2rem; color: #4CAF50; margin-bottom: 10px;">Pembayaran Berhasil!</h1>
        <p style="font-size: 1.1rem; color:#333;">Terima kasih, pembayaran Anda sudah kami terima.</p>

        <div style="background:#fff; margin-top:25px; padding:20px; border-radius:12px; text-align:left;">
            <p><strong>Order ID:</strong> {{ $order->id }}</p>
            <p><strong>Metode:</strong> QRIS</p>
            <p><strong>Total:</strong> Rp {{ number_format($order->total, 0, ',', '.') }}</p>
            <p><strong>Meja:</strong> {{ $order->table->name ?? $order->table_id }}</p>
        </div>

        <div style="margin-top:30px;">
            <a href="{{ url('/table/' . $order->table_id) }}"
               style="background:#4CAF50; padding:12px 30px; border-radius:8px; color:white; text-decoration:none;">
               Kembali ke Menu
            </a>
        </div>
    

    {{-- ===== KASIR VIEW ===== --}}
    @else
        <h1 style="font-size: 1.8rem; color:#c62828; margin-bottom: 15px;">
            Silahkan Lanjutkan Pembayaran di Kasir
        </h1>

        {{-- NOMOR MEJA --}}
        <div style="font-size: 3.2rem; font-weight: 700; background:white; padding:20px; border-radius:12px; color:#c62828; margin-bottom:25px;">
            {{ $order->table->name ?? $order->table_id }}
        </div>

        {{-- RINGKASAN TOTAL --}}
        <div style="background:white; padding:20px; border-radius:12px; text-align:left;">
            <p style="font-size:1.1rem;"><strong>Subtotal:</strong> Rp {{ number_format($order->subtotal, 0, ',', '.') }}</p>
            <p style="font-size:1.1rem;"><strong>Pajak (10%):</strong> Rp {{ number_format($order->tax, 0, ',', '.') }}</p>

            <hr style="margin:10px 0;">

            <p style="font-size: 1.4rem; font-weight:700; color:#c62828;">
                Total: Rp {{ number_format($order->total, 0, ',', '.') }}
            </p>
        </div>

        <div style="margin-top:30px;">
            <a href="{{ url('/table/' . $order->table_id) }}"
               style="background:#c62828; padding:14px 32px; border-radius:8px; color:white; text-decoration:none; font-size:1.1rem;">
               Kembali ke Menu
            </a>
        </div>
    @endif

</div>
@endsection
