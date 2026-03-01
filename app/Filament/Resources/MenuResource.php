<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Models\Menu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ToggleColumn;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Menu Name
                Forms\Components\TextInput::make('name')
                    ->label('Menu Name')
                    ->required()
                    ->maxLength(255),

                // Description
                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->maxLength(1000),

                // Price
                Forms\Components\TextInput::make('price')
                    ->label('Price')
                    ->required()
                    ->numeric()
                    ->maxLength(10),

                // Category dropdown
                Forms\Components\Select::make('category_id')
                    ->label('Sub Category')
                    ->relationship(
                        'category',
                        'name',
                        fn ($query) => $query->whereNotNull('parent_id')
                    )
                    ->searchable()
                    ->preload()
                    ->required(),


                // Menu Image
                Forms\Components\FileUpload::make('menu_image')
                    ->label('Menu Image')
                    ->disk('public') // Specify disk
                    ->image() // Ensure only images are uploaded
                    ->maxSize(1024) // Limit the image size to 1MB
                    ->columnSpan(2), // Optional: spans across 2 columns

                Forms\Components\Toggle::make('is_available')
                    ->label('Tersedia')
                    ->default(true),

                Forms\Components\CheckboxList::make('optionGroups')
                    ->label('Option Groups')
                    ->relationship('optionGroups', 'name')
                    ->columns(2)
                    ->searchable()
                
                            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Menu Name'),
                TextColumn::make('description')->label('Description'),
                TextColumn::make('price')->label('Price'),
                TextColumn::make('category.name')
                ->label('Sub Category'),

                TextColumn::make('category.parent.name')
                ->label('Main Category')
                ->default('-'),
                ToggleColumn::make('is_available')
                 ->label('Tersedia'),
            ])
            ->filters([
                // Add filters if necessary
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
       return [
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
