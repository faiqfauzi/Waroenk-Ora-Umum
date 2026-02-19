<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubCategoryResource\Pages;
use App\Models\Category;
use App\Models\SubCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SubCategoryResource extends Resource
{
    protected static ?string $model = SubCategory::class;

    public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->whereNotNull('parent_id');
}

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Select::make('parent_id')
                ->label('Main Category')
                ->options(
                    Category::whereNull('parent_id')->pluck('name', 'id')
                )
                ->required(),

            Forms\Components\TextInput::make('name')
                ->label('Sub Category Name')
                ->required()
                ->maxLength(255),
        ]);
}


   public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('name')->label('Sub Category'),
            TextColumn::make('parent.name')->label('Main Category'),
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
            'index' => Pages\ListSubCategories::route('/'),
            'create' => Pages\CreateSubCategory::route('/create'),
            'edit' => Pages\EditSubCategory::route('/{record}/edit'),
        ];
    }
}
