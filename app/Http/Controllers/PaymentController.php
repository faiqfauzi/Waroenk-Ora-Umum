<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use App\Models\OptionValue;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function manual(Request $request, $tableId)
{
    $request->validate([
        'items'  => 'required',
        'method' => 'required|in:qris,kasir',
        'notes'  => 'nullable|string',
        'proof'  => $request->method === 'qris' 
                        ? 'required|image|max:5120'
                        : 'nullable'
    ]);

    $items = json_decode($request->items, true);

    DB::beginTransaction();

    try {

        $subtotal = 0;

        foreach ($items as $item) {

            $menu = Menu::findOrFail($item['id']);

            $basePrice = $menu->price;

            // Ambil semua option id yang dipilih
            $optionIds = collect($item['options'] ?? [])
                            ->pluck('id')
                            ->filter()
                            ->toArray();

            $optionValues = OptionValue::whereIn('id', $optionIds)
                ->where('is_available', true)
                ->get();

            $additional = $optionValues->sum('additional_price');

            $finalPrice = ($basePrice + $additional);

            $subtotal += $finalPrice * $item['quantity'];
        }

        $tax = floor($subtotal * 0.10);
        $total = $subtotal + $tax;

        // Upload proof jika ada
        $proofPath = null;
        if ($request->method === 'qris' && $request->hasFile('proof')) {
            $proofPath = $request->file('proof')->store('proofs', 'public');
        }

        $order = Order::create([
            'table_id' => $tableId,
            'method'   => $request->method,
            'subtotal' => $subtotal,
            'tax'      => $tax,
            'total'    => $total,
            'notes'    => $request->notes,
            'proof'    => $proofPath,
            'status'   => 'pending'
        ]);

        foreach ($items as $item) {

            OrderItem::create([
                'order_id' => $order->id,
                'name'     => $item['name'],
                'quantity' => $item['quantity'],
                'price'    => $item['price'], // ini hanya display
                'options' => $item['options'] ?? [],
            ]);
        }

        DB::commit();

        return response()->json([
            'success' => true,
            'order_id' => $order->id
        ]);

    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan.'
        ], 500);
    }
}

}
