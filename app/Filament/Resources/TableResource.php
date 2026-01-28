<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TableResource\Pages;
use App\Filament\Resources\TableResource\RelationManagers;
use App\Models\Table as TableModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class TableResource extends Resource
{
    protected static ?string $model = TableModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Meja')
                    ->required()
                    ->maxLength(255), // Menambahkan input untuk nama meja
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nama Meja'), // Menampilkan nama meja
                  ImageColumn::make('qr_code')  // Gambar QR Code dari path yang ada
                    ->label('QR Code')             // Menambahkan label
                    ->disk('public')               // Menggunakan disk public untuk penyimpanan gambar
                                // Mengindikasikan bahwa ini adalah gambar
                    ->sortable(),
            
            ])
            
            ->filters([
                // Anda bisa menambahkan filter jika dibutuhkan
            ])
            ->actions([
                EditAction::make(), // Aksi untuk mengedit meja
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(), // Aksi untuk menghapus meja secara massal
                ]),
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
            'index' => Pages\ListTables::route('/'),
            'create' => Pages\CreateTable::route('/create'),
            'edit' => Pages\EditTable::route('/{record}/edit'),
        ];
    }
}
