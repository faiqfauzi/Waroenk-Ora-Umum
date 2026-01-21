<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class PaymentController extends Controller
{
    public function manual(Request $request, $tableId)
    {
        // Validasi dasar
        $request->validate([
            'items'     => 'required',
            'subtotal'  => 'required|integer',
            'tax'       => 'required|integer',
            'total'     => 'required|integer',
            'method'    => 'required|in:qris,kasir',
            'notes'     => 'nullable|string',
            'proof'     => $request->method === 'qris' 
                            ? 'required|image|max:5120'  // 5 MB
                            : 'nullable'
        ]);

        // Simpan bukti pembayaran jika QRIS
        $proofPath = null;
        if ($request->method === 'qris' && $request->hasFile('proof')) {
            $proofPath = $request->file('proof')->store('proofs', 'public');
        }

        // Buat order
        $order = Order::create([
            'table_id' => $tableId,
            'method'   => $request->method,
            'subtotal' => $request->subtotal,
            'tax'      => $request->tax,
            'total'    => $request->total,
            'notes'    => $request->notes,
            'proof'    => $proofPath,
            'status'   => 'pending'
        ]);

        // Simpan item
        $items = json_decode($request->items, true);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'name'     => $item['name'],
                'quantity' => $item['quantity'],
                'price'    => $item['price']
            ]);
        }

        // Respon ke frontend
        return response()->json([
            'success' => true,
            'order_id' => $order->id
        ]);
    }
}
