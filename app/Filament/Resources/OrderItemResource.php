<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderItemResource\Pages;
use App\Filament\Resources\OrderItemResource\RelationManagers;
use App\Models\OrderItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderItemResource extends Resource
{
    protected static ?string $model = OrderItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 TextColumn::make('order_id')
                ->label('Order ID')
                ->sortable(),  

                TextColumn::make('name')
                    ->label('Menu')
                    ->sortable(), // Menampilkan nama menu yang terkait dengan OrderItem

                TextColumn::make('quantity')
                    ->label('Quantity')
                    ->sortable(), // Menampilkan jumlah item yang dipesan

                TextColumn::make('price')
                    ->label('Price')
                    ->sortable()
                    ->money('IDR', true), // Format uang untuk IDR

                TextColumn::make('order.table.name')
                    ->label('Table')
                    ->sortable(), // Menampilkan nama meja terkait dengan order

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime(), // Menampilkan tanggal dibuat
            ])
            ->filters([
                // Anda dapat menambahkan filter jika diperlukan
            ])
            ->actions([])  // Tidak ada aksi (seperti edit) pada tabel ini
            ->bulkActions([]);  // Tidak ada aksi bulk (hapus banyak) juga
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrderItems::route('/'),
        ];
    }
}
