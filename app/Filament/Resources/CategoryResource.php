<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                                          ->required()
                                          ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                                          ->required()
                                          ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                                         ->label('Detaylı Gör')
                                         ->modalHeading('Kategori Detayları')
                                         ->icon('heroicon-o-eye')
                                         ->color('info'),
                Tables\Actions\EditAction::make(),
            ]);
    }
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Kategori Bilgileri')
                                            ->schema([
                                                Infolists\Components\TextEntry::make('name')
                                                                              ->label('Kategori Adı')
                                                                              ->weight('bold')
                                                                              ->size('lg'),
                                                Infolists\Components\TextEntry::make('slug')
                                                                              ->label('URL Uzantısı')
                                                                              ->badge()
                                                                              ->color('success'),
                                                Infolists\Components\TextEntry::make('created_at')
                                                                              ->label('Oluşturulma Tarihi')
                                                                              ->dateTime(),
                                            ])->columns(2)
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
