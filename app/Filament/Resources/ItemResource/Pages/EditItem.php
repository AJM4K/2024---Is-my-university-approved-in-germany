<?php

namespace App\Filament\Resources\ItemResource\Pages;

use App\Filament\Resources\ItemMovementResource;
use App\Filament\Resources\ItemResource;
use App\Models\Item;
use Filament\Actions;
use Filament\Actions\Action as ActionsAction;
use Filament\Actions\Modal\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditItem extends EditRecord
{
    protected static string $resource = ItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('viewMovements')
            ->label('View Movements')
            ->url(fn (Item $record) => ItemMovementResource::getUrl('view-item-movements', ['itemId' => $record->id])),
   
            
        ];
    }
}
