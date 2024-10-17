<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemMovementResource\Pages;
use App\Filament\Resources\ItemMovementResource\RelationManagers;
use App\Models\Item;
use App\Models\ItemMovement;
use App\Models\ItemsMovement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemMovementResource extends Resource
{
    protected static ?string $model = ItemsMovement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function getLabel(): string
    {
        return 'سجل الحركات'; // Custom sidebar name
    }
  
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('item_id')
                    ->label('Item')
                    ->relationship('Item', 'name')
                    ->required(),

                    Forms\Components\Select::make('movement_type')
                    ->label('Movement Type')
                    ->options([
                        'in' => 'In',
                        'out' => 'Out',
                    ])
                    ->required(),
    
                
                  
            Forms\Components\TextInput::make('quantity')
            ->label('Quantity')
            ->required()
            ->type('number')
            ->reactive()
            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                $item = Item::find($get('item_id'));
                if ($get('movement_type') === 'in' && $state > $item->out_quantity) {
                    $set('quantity', $item->out_quantity); // Adjust to available out_quantity
                } elseif ($get('movement_type') === 'out' && $state > $item->in_quantity) {
                    $set('quantity', $item->in_quantity); // Adjust to available in_quantity
                }
            }),
                    

                Forms\Components\TextInput::make('location')
                    ->nullable()
                    ->maxLength(255),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('item.name')->label('Item'),
                Tables\Columns\TextColumn::make('quantity'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListItemMovements::route('/'),
            'create' => Pages\CreateItemMovement::route('/create'),
            'edit' => Pages\EditItemMovement::route('/{record}/edit'),
        ];
    }
}