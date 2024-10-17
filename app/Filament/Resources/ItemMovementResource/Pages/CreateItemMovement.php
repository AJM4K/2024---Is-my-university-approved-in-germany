<?php

namespace App\Filament\Resources\ItemMovementResource\Pages;

use App\Filament\Resources\ItemMovementResource;
use App\Models\Item;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateItemMovement extends CreateRecord
{
    protected static string $resource = ItemMovementResource::class;
   
    protected function afterCreate(): void
    {
        $itemMovement =$this->record;
        $item = Item::Find($itemMovement->item_id);


        if ($itemMovement['type'] === 'in') {
            $item->in_quantity += $itemMovement['quantity'];
            $item->out_quantity -= $itemMovement['quantity'];

        } else {
            $item->out_quantity += $itemMovement['quantity'];
            $item->in_quantity -= $itemMovement['quantity'];

        }

        $item->save();
    }

    protected function afterSavc(): void{
        
    }
}
