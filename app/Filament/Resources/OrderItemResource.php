<?php

namespace App\Filament\Resources;

use App\Models\OrderItem;
use Filament\Resources\Resource;

class OrderItemResource extends Resource
{
    protected static ?string $model = OrderItem::class;

    protected static bool $shouldRegisterNavigation = false;
}
