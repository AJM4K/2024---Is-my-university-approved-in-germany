<?php

namespace App\Filament\Resources\ItemResource\Pages;

use App\Filament\Resources\ItemMovementResource;
use App\Filament\Resources\ItemResource;
use App\Models\Item;
use Filament\Actions;

use Filament\Resources\Pages\ViewRecord;

class ViewItem extends ViewRecord
{
    protected static string $resource = ItemResource::class;

    protected function getHeaderActions(): array
{
    return [
        Actions\Action::make('viewMovements')
        ->label('View Movements')
        ->url(fn (Item $record) => ItemMovementResource::getUrl('view-item-movements', ['itemId' => $record->id])),

        Actions\EditAction::make(),
        Actions\DeleteAction::make(),
    ];
}

}
