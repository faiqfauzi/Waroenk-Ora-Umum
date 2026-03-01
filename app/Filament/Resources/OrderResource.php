<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path-rounded-square';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'diproses' => 'Diproses',
                    'selesai' => 'Selesai',
                    'dibatalkan' => 'Dibatalkan',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->poll('5s')
            ->filters([
            Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('from')->label('Dari'),
                        Forms\Components\DatePicker::make('until')->label('Sampai'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'] ?? null, function ($q, $date) {
                                $q->whereDate('created_at', '>=', $date);
                            })
                            ->when($data['until'] ?? null, function ($q, $date) {
                                $q->whereDate('created_at', '<=', $date);
                            });
                    }),
            ])
            ->columns([

                TextColumn::make('id')
                    ->label('Order ID')
                    ->sortable(),

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
                    ->size(60)
                    ->visible(fn ($record) => $record && $record->method === 'qris'),

                BadgeColumn::make('status')
                    ->colors([
                        'gray' => 'pending',
                        'warning' => 'diproses',
                        'success' => 'selesai',
                        'danger' => 'dibatalkan',
                    ])
                    ->label('Status'),

                TextColumn::make('total')
                    ->money('IDR')
                    ->label('Total')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y - H:i')
                    ->sortable(),

                


            ])
            ->actions([

            Tables\Actions\Action::make('Lihat Bukti')
                ->visible(fn ($record) => $record && $record->method === 'qris')
                ->modalHeading('Bukti Pembayaran')
                ->modalContent(function ($record) {
                    if (!$record->proof) {
                        return "Tidak ada bukti pembayaran.";
                    }
            
                    return view('filament.modals.proof-viewer', [
                        'image' => $record->proof,
                    ]);
                })
                ->modalSubmitAction(false),

            Tables\Actions\Action::make('lihatItems')
                ->label('Lihat Items')
                ->modalHeading('Detail Pesanan')
                ->modalContent(function ($record) {
                    return view('filament.modals.order-items', [
                        'items' => $record->items,
                        'subtotal' => $record->subtotal,
                        'tax' => $record->tax,
                        'total' => $record->total,
                        'order'    => $record,
                    ]);
                })
                ->modalSubmitAction(false),

            

                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        $count = Order::where('status', 'pending')->count();
        return $count > 0 ? (string)$count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
