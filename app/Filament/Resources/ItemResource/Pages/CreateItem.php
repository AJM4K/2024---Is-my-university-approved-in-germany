<?php

namespace App\Filament\Resources\ItemResource\Pages;

use App\Filament\Resources\ItemResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;

class CreateItem extends CreateRecord
{
    protected static string $resource = ItemResource::class;

    protected function afterCreate(): void
{
    Log::info('After create method triggered.');

    // Access the created item directly from the data
    $item = $this->record; // Retrieve the item by ID

    if ($item) {

        // Set in_quantity and out_quantity
        $item->in_quantity = $item->quantity;
        $item->out_quantity = 0;

        // Save and log after saving
        if ($item->save()) {
            Log::info('Item updated after create:', ['in_quantity' => $item->in_quantity, 'out_quantity' => $item->out_quantity]);
        } else {
            Log::error('Failed to save item after create.');
        }
    }
}

}
