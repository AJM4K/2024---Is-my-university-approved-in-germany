<?php

namespace App\Filament\Resources\ItemMovementResource\Pages;

use App\Filament\Resources\ItemMovementResource;
use App\Models\Item;
use App\Models\ItemsMovement;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\Actions as ComponentsActions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditItemMovement extends EditRecord
{
    protected static string $resource = ItemMovementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->action(function ($record) {
                    // Your delete logic here
                    if (!$record->closed) {
                        Notification::make()
                            ->title('Error')
                            ->body('Related item need to be closed or super admin.')
                            ->warning()
                            ->send();
                        return;
                    }

                    $record->delete();
                    Notification::make()
                        ->title('Success')
                        ->body('Item movement deleted successfully.')
                        ->success()
                        ->send();
                }),
            Actions\Action::make('close')
                ->label('Close Movement')
                ->action(function (ItemsMovement $record) {
                    // Find the related item
                    $item = Item::find($record->item_id);
                    if (!$item) {
                        Notification::make()
                            ->title('Error')
                            ->body('Related item not found.')
                            ->danger()
                            ->send();
                        return;
                    }

                   
                        $item->in_quantity += $record->quantity;
                   
                        $item->out_quantity -= $record->quantity;
                    

                    // Close the movement
                    $record->update(['closed' => true]);
                    $item->save(); // Save the updated item

                    Notification::make()
                        ->title('Success')
                        ->body('Item movement closed and quantities updated successfully.')
                        ->success()
                        ->send();
                })
                ->requiresConfirmation()->hidden(fn(ItemsMovement $record) => $record->closed), // Hide if closed is true


        ];
    }
}
