<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Category, Table, Order, OrderItem};

class OrderController extends Controller
{
    public function showTable($id)
{
    $table = Table::findOrFail($id);

    $categories = Category::whereNull('parent_id')
    ->with([
        'children.menus.optionGroups.values'
    ])
    ->get();


    return view('order.menu', compact('table', 'categories'));
}

    
 public function checkout(Request $request, $tableId)
{
    // Mengambil data cart yang dikirim dari frontend
    $items = is_string($request->items) ? json_decode($request->items, true) : $request->items;

    // Membuat pesanan baru
    $order = Order::create([
        'table_id' => $tableId,
        'total' => $request->total,
        'status' => 'pending',
    ]);

    // Menyimpan setiap item pesanan ke tabel order_items
    foreach ($items as $item) {
      
        $orderItem = OrderItem::create([
        'order_id' => $order->id,
        'table_id' => $tableId,
        'menu' => $item['name'],
        'quantity' => $item['quantity'],
        'price' => $item['price'],
        'options' => isset($item['options']) 
            ? json_encode($item['options']) 
            : null,
    ]);
}
return response()->json(['order_id' => $order->id, 'total' => $order->total]);


}
public function confirmPayment(Request $request, $id)
{
    // Find the order by ID
    $order = Order::findOrFail($id);

    // Update the order status to 'paid'
    $order->status = 'paid';
    $order->save();

    // Return success response
    return response()->json([
        'status' => 'success',
        'message' => 'Pembayaran Berhasil!'
    ]);
}
}
