<?php 
namespace App\Filament\Resources\ItemMovementResource\Pages;

use App\Filament\Resources\ItemMovementResource;
use App\Models\ItemsMovement; // Ensure you're using the correct model
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class ItemMovementsForItem extends ListRecords
{
    protected static string $resource = ItemMovementResource::class;
    protected ?int $itemId = null; // Declare the itemId property

    public function mount(): void
    {
        $this->itemId = request()->route('itemId'); // Access the item ID from the route
    }

    protected function getTableQuery(): Builder
    {
        // Filter item movements by the specific item ID
        return ItemsMovement::where('item_id', $this->itemId);
    }

    public function getHeading(): string
    {
        return 'Item Movements for Item ID: ' . $this->itemId;
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('id'),
            Tables\Columns\TextColumn::make('item_id'),
            Tables\Columns\TextColumn::make('description'),
            Tables\Columns\TextColumn::make('location'),
            Tables\Columns\TextColumn::make('type'),
            Tables\Columns\TextColumn::make('quantity'),
            Tables\Columns\TextColumn::make('created_at')->dateTime(),
        ];
    }
    public static function getRoute(): string
    {
        return '/item-movements/item/{itemId}'; // Define the route here
    }
}
