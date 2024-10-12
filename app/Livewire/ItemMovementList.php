<?php

namespace App\Livewire;

use App\Models\ItemsMovement;
use Livewire\Component;

class ItemMovementList extends Component
{
    public $movements;

    public function mount()
    {
        // Fetch item movements when the component mounts
        $this->movements = ItemsMovement::with('item')->get();
    }

    public function deleteItemsMovement($id)
    {
        // Find the movement and delete it
        $itemsMovement = ItemsMovement::find($id);

            $itemsMovement->delete();

            session()->flash('message', 'تم اجراء بنجاح');
            $this->movements = ItemsMovement::with('item')->get();


    }
    public function render()
    {
        return view('livewire.item-movement-list');
    }
}
