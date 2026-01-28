<div>
    <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 12px;">Daftar Pesanan</h3>

    <div style="line-height: 1.6;">
        @foreach ($items as $item)
            <div style="margin-bottom: 6px;">
                • {{ $item->name }} 
                <strong>x{{ $item->quantity }}</strong>
                <span>
                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                </span>
            </div>
        @endforeach
    </div>

    <hr style="margin: 15px 0;">

    <div style="font-size: 15px;">
        <div style="display:flex; justify-content:space-between;">
            <span>Subtotal</span>
            <strong>Rp {{ number_format($subtotal, 0, ',', '.') }}</strong>
        </div>

        <div style="display:flex; justify-content:space-between;">
            <span>Pajak (10%)</span>
            <strong>Rp {{ number_format($tax, 0, ',', '.') }}</strong>
        </div>

        <div style="display:flex; justify-content:space-between; font-size:17px; margin-top:6px;">
            <span>Total</span>
            <strong>
                Rp {{ number_format($total, 0, ',', '.') }}
            </strong>
        </div>
    </div>
</div>
