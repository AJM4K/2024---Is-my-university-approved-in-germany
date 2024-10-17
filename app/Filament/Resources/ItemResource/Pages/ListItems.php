<?php

namespace App\Filament\Resources\ItemResource\Pages;

use App\Filament\Resources\ItemMovementResource;
use App\Filament\Resources\ItemResource;
use App\Models\Item;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItems extends ListRecords
{
    protected static string $resource = ItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
          
        ];
    }




 
}
