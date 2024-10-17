<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemResource\Pages;
use App\Filament\Resources\ItemResource\RelationManagers;
use App\Models\Item;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Actions;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

   

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('quantity')
                ->label('Quantity')
                ->required()
                ->type('number')
                ->reactive()
                ->afterStateUpdated(function ($state, callable $get, callable $set) {
                    // Log::info('Quantity updated:', ['quantity' => $state]);
                    // // Set in_quantity and out_quantity based on quantity
                    // $set('in_quantity', $state);
                    // $set('out_quantity', 0);
                }),

            Forms\Components\TextInput::make('in_quantity')
                ->label('In Quantity')
                ->type('number')
                ->default(0)

              //  ->readonly(), // Change disabled() to readonly()
              ->disabled(fn($get) => $get('id') === null),

                

            // Forms\Components\TextInput::make('out_quantity')
            //     ->label('Out Quantity')
            //     ->type('number')
            //     ->readonly(), // Change disabled() to readonly()
            Forms\Components\TextInput::make('out_quantity')->default(0)->readOnly(),

                

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
            Tables\Actions\Action::make('view')
            ->label('View Details')
            ->action(function (Item $record) {
                return redirect()->to(ItemResource::getUrl('view', ['record' => $record->id]));
            }),
           // Tables\Actions\EditAction::make(),
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
            'view' => Pages\ViewItem::route('/{record}'), // Add this line

        ];
    }
  
    

}
