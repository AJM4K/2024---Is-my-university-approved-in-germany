<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemResource\Pages;
use App\Filament\Resources\ItemResource\RelationManagers;
use App\Models\Item;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            
                Forms\Components\TextInput::make('quantity')
                ->label('Quantity')
                ->required()
                ->type('number')
                ->reactive()
                ->afterStateUpdated(function ($state, callable $get, callable $set) {
                        $set('in_quantity', $state); // Adjust to available out_quantity
                        $set('out_quantity', 0); // Adjust to available in_quantity
                    
                }),
            
                Forms\Components\TextInput::make('in_quantity')
                ->required()
                ->type('number')
                ->disabled(),
                Forms\Components\TextInput::make('out_quantity')
                ->required()
                ->disabled()
                ->type('number'),

                

            Forms\Components\Textarea::make('description')
                ->nullable()
                ->maxLength(65535),

            Forms\Components\TextInput::make('location')
                ->nullable()
                ->maxLength(255),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('id'),
            Tables\Columns\TextColumn::make('name'),
            Tables\Columns\TextColumn::make('quantity'),
            Tables\Columns\TextColumn::make('in_quantity'),
            Tables\Columns\TextColumn::make('out_quantity'),
            Tables\Columns\TextColumn::make('location'),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Created At')
                ->dateTime(),
            Tables\Columns\TextColumn::make('updated_at')
                ->label('Updated At')
                ->dateTime(),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }
}
