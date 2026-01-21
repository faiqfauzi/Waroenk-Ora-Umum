@extends('layouts.app')

@section('title', 'Pembayaran Berhasil')

@section('content')
    <div class="success-container" style="text-align: center; padding: 50px 15px; background-color: #f4f4f4; border-radius: 8px; max-width: 600px; margin: auto;">
        <div style="background-color: #4CAF50; padding: 20px; border-radius: 50%; display: inline-block; margin-bottom: 20px;">
            <img src="https://img.icons8.com/ios/452/checked.png" alt="Success Icon" style="width: 70px; height: 70px;">
        </div>
        
        <h1 style="font-size: 2.5rem; color: #4CAF50;">Pembayaran Berhasil!</h1>
        <p style="font-size: 1.2rem; color: #333;">Terima kasih atas pesanan Anda. Kami telah menerima pembayaran Anda dengan sukses.</p>

        <div style="background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-top: 30px;">
            <p style="font-size: 1.1rem; color: #555; margin-bottom: 10px;"><strong>Order ID:</strong> <span style="color: #4CAF50;">{{ $orderId }}</span></p>
            <p style="font-size: 1.1rem; color: #555; margin-bottom: 10px;"><strong>Total Pembayaran:</strong> Rp {{ number_format($totalAmount, 0, ',', '.') }}</p>
            <p style="font-size: 1.1rem; color: #555; margin-bottom: 10px;"><strong>Metode Pembayaran:</strong> {{ $paymentMethod }}</p>
            <p style="font-size: 1.1rem; color: #555; margin-bottom: 10px;"><strong>Meja ID:</strong> <span style="color: #4CAF50;">{{ $tableId }}</span></p>
        </div>

        <div style="margin-top: 30px;">
            <!-- Update the link to redirect to the table's menu page -->
            <a href="{{ url('/table/' . $tableId) }}" class="btn btn-primary" style="background-color: #4CAF50; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px;">Kembali ke Halaman Menu</a>
        </div>
    </div>
@endsection
