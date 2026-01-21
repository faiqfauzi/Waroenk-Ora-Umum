<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Carbon\Carbon;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('status')
                ->options([
                    'waiting' => 'Waiting',
                    'process' => 'Diproses',
                    'done' => 'Selesai',
                    'cancelled' => 'Dibatalkan',
                ])
                ->required(),

            Forms\Components\TextInput::make('notes')
                ->label('Catatan')
                ->disabled(),

            Forms\Components\TextInput::make('method')
                ->disabled(),

            Forms\Components\TextInput::make('subtotal')->disabled(),
            Forms\Components\TextInput::make('tax')->disabled(),
            Forms\Components\TextInput::make('total')->disabled(),

            Forms\Components\FileUpload::make('proof')
                ->label('Bukti Pembayaran')
                ->disk('public')
                ->image()
                ->directory('proofs')
                ->hidden(fn ($record) => $record->method !== 'qris'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Order ID')->sortable(),

            TextColumn::make('table.name')
                ->label('Meja')
                ->sortable(),

            TextColumn::make('method')
                ->label('Metode')
                ->badge()
                ->colors([
                    'primary' => 'qris',
                    'warning' => 'kasir',
                ]),

            ImageColumn::make('proof')
                ->label('Bukti Pembayaran')
                ->disk('public')
                ->hidden(fn ($record) => $record?->method !== 'qris')
                ->size(60),

            BadgeColumn::make('status')
                ->colors([
                    'gray' => 'waiting',
                    'warning' => 'process',
                    'success' => 'done',
                    'danger' => 'cancelled',
                ])
                ->label('Status'),

            TextColumn::make('total')
                ->money('IDR')
                ->label('Total')
                ->sortable(),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ]);
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
            'index' => Pages\ListOrders::route('/'),
        ];
    }
}
