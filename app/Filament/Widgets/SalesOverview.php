<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Order;

class SalesOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Penjualan (Berhasil)', 
                'IDR ' . number_format(Order::where('status', 'success')->sum('total'), 0, ',', '.')),
            Stat::make('Jumlah Transaksi', 
                Order::where('status', 'success')->count()),
        ];
    }
}
