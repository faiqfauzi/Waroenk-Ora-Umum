<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OptionGroupResource\Pages;
use App\Models\OptionGroup;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OptionGroupResource extends Resource
{
    protected static ?string $model = OptionGroup::class;

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            TextInput::make('name')
                ->required()
                ->maxLength(255),

            Select::make('type')
                ->options([
                    'single' => 'Single',
                    'multiple' => 'Multiple',
                ])
                ->required(),

            Toggle::make('is_active')
                ->default(true),

            Repeater::make('values')
                ->relationship('values')
                ->schema([
                    TextInput::make('label')
                        ->required(),

                    TextInput::make('additional_price')
                        ->numeric()
                        ->default(0)
                        ->required(),

                    Toggle::make('is_available')
                        ->default(true),
                ])
                ->collapsible()
                ->cloneable()
                ->defaultItems(1),
        ]);
}

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Nama Group')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('type')
                ->label('Tipe')
                ->badge()
                ->color(fn (string $state) => match ($state) {
                    'single' => 'info',
                    'multiple' => 'success',
                }),

            Tables\Columns\TextColumn::make('values_count')
                ->counts('values')
                ->label('Jumlah Opsi'),

            Tables\Columns\IconColumn::make('is_active')
                ->label('Aktif')
                ->boolean(),
        ])
        ->defaultSort('created_at', 'desc')
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListOptionGroups::route('/'),
            'create' => Pages\CreateOptionGroup::route('/create'),
            'edit' => Pages\EditOptionGroup::route('/{record}/edit'),
        ];
    }
}
