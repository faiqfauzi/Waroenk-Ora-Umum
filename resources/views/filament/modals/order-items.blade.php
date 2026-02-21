<div>
    <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 12px;">
        Daftar Pesanan
    </h3>

    <div style="line-height: 1.6;">
        @foreach ($items as $item)
            <div style="margin-bottom: 12px;">

                <div>
                    • {{ $item->name }}
                    <strong>x{{ $item->quantity }}</strong>
                </div>

                {{-- 🔥 TAMPILKAN OPTIONS --}}
                @if (!empty($item->options))
                    <div style="margin-left: 18px; font-size: 13px; color: #555;">
                        @foreach ($item->options as $option)
                            <div>
                                + {{ $option['label'] }}
                                @if(($option['price'] ?? 0) > 0)
                                    ( +Rp {{ number_format($option['price'], 0, ',', '.') }} )
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif

                <div style="margin-top: 4px;">
                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                </div>

            </div>
        @endforeach

        @if(!empty($order->notes))
            <div style="margin-top: 15px;">
                <strong>Catatan:</strong>
                <div style="margin-top: 6px; font-size: 14px; color: #aaa;">
                    {{ $order->notes }}
                </div>
            </div>
        @endif
    </div>

    <hr style="margin: 15px 0;">

    <div style="font-size: 15px;">
        <div style="margin-top: 10px; margin-bottom: 10px;">
            <strong>Metode Pembayaran:</strong>
            <div style="margin-top: 4px; font-size: 14px; color: #aaa;">
                {{ strtoupper($order->method) }}
            </div>
        </div>
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
