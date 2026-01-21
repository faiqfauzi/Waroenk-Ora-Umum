<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;


    protected $fillable = [
        'table_id', 
        'method',
        'subtotal',
        'tax',
        'total',
        'notes',
        'proof',
        'status'
        // 'total', 
        // 'status', 
        // 'cart_data' // Tambahkan baris ini
    ];

    // Tambahkan casting agar array otomatis jadi JSON saat disimpan
    protected $casts = [
        'cart_data' => 'array',
    ];


    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);  // Relasi dengan OrderItem
    }

    public function table()
    {
        return $this->belongsTo(Table::class);  // Relasi dengan Table
    }
}
